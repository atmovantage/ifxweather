<?php

namespace UserFrosting;

/**
 * UserController Class
 *
 * Controller class for /users/* URLs.  Handles user-related activities, including listing users, CRUD for users, etc.
 *
 * @package UserFrosting
 * @author Alex Weissman
 * @link http://www.userfrosting.com/navigating/#structure
 */
class UserController extends \UserFrosting\BaseController {

    /**
     * Create a new UserController object.
     *
     * @param UserFrosting $app The main UserFrosting app.
     */
    public function __construct($app){
        $this->_app = $app;
    }

    /**
     * Renders the user listing page.
     *
     * This page renders a table of users, with dropdown menus for admin actions for each user.
     * Actions typically include: edit user details, activate user, enable/disable user, delete user.
     * This page requires authentication.
     * Request type: GET
     * @param string $primary_group_name optional.  If specified, will only display users in that particular primary group.
     * @todo implement interface to modify user-assigned authorization hooks and permissions
     */        
    public function pageUsers($primary_group_name = null){
        // Optional filtering by primary group
        if ($primary_group_name){
            $primary_group = GroupLoader::fetch($primary_group_name, 'name');
            
            if (!$primary_group)
                $this->_app->notFound();
            
            // Access-controlled page
            if (!$this->_app->user->checkAccess('uri_group_users', ['primary_group_id' => $primary_group->id])){
                $this->_app->notFound();
            }
        
            $users = UserLoader::fetchAll($primary_group->id, 'primary_group_id');
            $name = $primary_group->name;
            $icon = $primary_group->icon;

        } else {
            // Access-controlled page
            if (!$this->_app->user->checkAccess('uri_users')){
                $this->_app->notFound();
            }
            
            $users = UserLoader::fetchAll();
            $name = "Users";
            $icon = "fa fa-users";
        }
        
        $this->_app->render('users.html', [
            'page' => [
                'author' =>         $this->_app->site->author,
                'title' =>          $name,
                'description' =>    "A listing of the users for your site.  Provides management tools including the ability to edit user details, manually activate users, enable/disable users, and more.",
                'alerts' =>         $this->_app->alerts->getAndClearMessages()
            ],
            "box_title" => $name,
            "icon" => $icon,
            "users" => $users
        ]);          
    }
    
    /**
     * Renders a page displaying a user's information, in read-only mode.
     *
     * This checks that the currently logged-in user has permission to view the requested user's info.
     * It checks each field individually, showing only those that you have permission to view.
     * This will also try to show buttons for activating, disabling/enabling, deleting, and editing the user.
     * This page requires authentication.
     * Request type: GET
     * @param string $user_id The id of the user to view.
     */  
    public function pageUser($user_id){
        // Get the user to view
        $target_user = UserLoader::fetch($user_id);    
        
        // Access-controlled resource
        if (!$this->_app->user->checkAccess('uri_users') && !$this->_app->user->checkAccess('uri_group_users', ['primary_group_id' => $target_user->primary_group_id])){
            $this->_app->notFound();
        }
    
        // Get a list of all groups
        $groups = GroupLoader::fetchAll();
        
        // Get a list of all locales
        $locale_list = $this->_app->site->getLocales();
        
        // Determine which groups this user is a member of
        $user_groups = $target_user->getGroups();
        foreach ($groups as $group_id => $group){
            $group_list[$group_id] = $group->export();
            if (isset($user_groups[$group_id]))
                $group_list[$group_id]['member'] = true;
            else
                $group_list[$group_id]['member'] = false;
        }    
    
        // Determine authorized fields
        $fields = ['display_name', 'email', 'title', 'locale', 'groups', 'primary_group_id'];
        $show_fields = [];
        $disabled_fields = [];
        $hidden_fields = [];
        foreach ($fields as $field){
            if ($this->_app->user->checkAccess("view_account_setting", ["user" => $target_user, "property" => $field]))
                $disabled_fields[] = $field;
            else
                $hidden_fields[] = $field;
        }    
        
        // Always disallow editing username
        $disabled_fields[] = "user_name";
        
        // Hide password fields for editing user
        $hidden_fields[] = "password";    
    
        $this->_app->render('user_info.html', [
            'page' => [
                'author' =>         $this->_app->site->author,
                'title' =>          "Users | " . $target_user->user_name,
                'description' =>    "User information page for " . $target_user->user_name,
                'alerts' =>         $this->_app->alerts->getAndClearMessages()
            ],
            "box_id" => 'view-user',
            "box_title" => $target_user->user_name,
            "target_user" => $target_user,
            "groups" => $group_list,
            "locales" => $locale_list,
            "fields" => [
                "disabled" => $disabled_fields,
                "hidden" => $hidden_fields
            ],
            "buttons" => [
                "hidden" => [
                    "submit", "cancel"
                ]
            ],
            "validators" => "{ none: ''}"           
        ]);   
    }

    /**
     * Renders the form for creating a new user.
     *
     * This does NOT render a complete page.  Instead, it renders the HTML for the form, which can be embedded in other pages.
     * The form can be rendered in "modal" (for popup) or "panel" mode, depending on the value of the GET parameter `render`.
     * If the currently logged-in user has permission to modify user group membership, then the group toggles will be displayed.
     * Otherwise, the user will be added to the default groups automatically.
     * This page requires authentication.
     * Request type: GET
     */  
    public function formUserCreate(){
        // Access-controlled resource
        if (!$this->_app->user->checkAccess('create_account')){
            $this->_app->notFound();
        }
        
        $get = $this->_app->request->get();
        
        if (isset($get['render']))
            $render = $get['render'];
        else
            $render = "modal";
        
        // Get a list of all groups
        $groups = GroupLoader::fetchAll();
        
        // Get a list of all locales
        $locale_list = $this->_app->site->getLocales();
        
        // Get default primary group (is_default = GROUP_DEFAULT_PRIMARY)
        $primary_group = GroupLoader::fetch(GROUP_DEFAULT_PRIMARY, "is_default");
        
        // Get the default groups
        $default_groups = GroupLoader::fetchAll(GROUP_DEFAULT, "is_default");
        
        // Set default groups, including default primary group
        foreach ($groups as $group_id => $group){
            $group_list[$group_id] = $group->export();
            if (isset($default_groups[$group_id]) || $group_id == $primary_group->id)
                $group_list[$group_id]['member'] = true;
            else
                $group_list[$group_id]['member'] = false;
        }
        
        $data['primary_group_id'] = $primary_group->id;
        // Set default title for new users
        $data['title'] = $primary_group->new_user_title;
        // Set default locale
        $data['locale'] = $this->_app->site->default_locale;
        
        // Create a dummy user to prepopulate fields
        $target_user = new User($data);        
        
        if ($render == "modal")
            $template = "components/user-info-modal.html";
        else
            $template = "components/user-info-panel.html";
        
        // Determine authorized fields for those that have default values.  Don't hide any fields
        $fields = ['title', 'locale', 'groups', 'primary_group_id'];
        $show_fields = [];
        $disabled_fields = [];
        $hidden_fields = [];
        foreach ($fields as $field){
            if ($this->_app->user->checkAccess("update_account_setting", ["user" => $target_user, "property" => $field]))
                $show_fields[] = $field;
            else
                $disabled_fields[] = $field;
        }    
        
        // Load validator rules
        $schema = new \Fortress\RequestSchema($this->_app->config('schema.path') . "/forms/user-create.json");
        $validators = new \Fortress\ClientSideValidator($schema, $this->_app->translator);           
        
        $this->_app->render($template, [
            "box_id" => $get['box_id'],
            "box_title" => "Create User",
            "submit_button" => "Create user",
            "form_action" => $this->_app->site->uri['public'] . "/users",
            "target_user" => $target_user,
            "groups" => $group_list,
            "locales" => $locale_list,
            "fields" => [
                "disabled" => $disabled_fields,
                "hidden" => $hidden_fields
            ],
            "buttons" => [
                "hidden" => [
                    "edit", "enable", "delete", "activate"
                ]
            ],
            "validators" => $validators->formValidationRulesJson()
        ]);   
    }  
        
    /**
     * Renders the form for editing an existing user.
     *
     * This does NOT render a complete page.  Instead, it renders the HTML for the form, which can be embedded in other pages.
     * The form can be rendered in "modal" (for popup) or "panel" mode, depending on the value of the GET parameter `render`.
     * For each field, we will first check if the currently logged-in user has permission to update the field.  If so,
     * the field will be rendered as editable.  If not, we will check if they have permission to view the field.  If so,
     * it will be displayed but disabled.  If they have neither permission, the field will be hidden.
     * This page requires authentication.
     * Request type: GET
     * @param int $user_id the id of the user to edit.
     */    
    public function formUserEdit($user_id){
        // Get the user to edit
        $target_user = UserLoader::fetch($user_id);        
        
        // Access-controlled resource
        if (!$this->_app->user->checkAccess('uri_users') && !$this->_app->user->checkAccess('uri_group_users', ['primary_group_id' => $target_user->primary_group_id])){
            $this->_app->notFound();
        }
        
        $get = $this->_app->request->get();
        
        if (isset($get['render']))
            $render = $get['render'];
        else
            $render = "modal";
        
        // Get a list of all groups
        $groups = GroupLoader::fetchAll();
        
        // Get a list of all locales
        $locale_list = $this->_app->site->getLocales();
        
        // Determine which groups this user is a member of
        $user_groups = $target_user->getGroups();
        foreach ($groups as $group_id => $group){
            $group_list[$group_id] = $group->export();
            if (isset($user_groups[$group_id]))
                $group_list[$group_id]['member'] = true;
            else
                $group_list[$group_id]['member'] = false;
        }
        
        if ($render == "modal")
            $template = "components/user-info-modal.html";
        else
            $template = "components/user-info-panel.html";
        
        // Determine authorized fields
        $fields = ['display_name', 'email', 'title', 'password', 'locale', 'groups', 'primary_group_id'];
        $show_fields = [];
        $disabled_fields = [];
        $hidden_fields = [];
        foreach ($fields as $field){
            if ($this->_app->user->checkAccess("update_account_setting", ["user" => $target_user, "property" => $field]))
                $show_fields[] = $field;
            else if ($this->_app->user->checkAccess("view_account_setting", ["user" => $target_user, "property" => $field]))
                $disabled_fields[] = $field;
            else
                $hidden_fields[] = $field;
        }
        
        // Always disallow editing username
        $disabled_fields[] = "user_name";
        
        // Hide password fields for editing user
        $hidden_fields[] = "password";
                
        // Load validator rules
        $schema = new \Fortress\RequestSchema($this->_app->config('schema.path') . "/forms/user-update.json");
        $validators = new \Fortress\ClientSideValidator($schema, $this->_app->translator);           
        
        $this->_app->render($template, [
            "box_id" => $get['box_id'],
            "box_title" => "Edit User",
            "submit_button" => "Update user",
            "form_action" => $this->_app->site->uri['public'] . "/users/u/$user_id",
            "target_user" => $target_user,
            "groups" => $group_list,
            "locales" => $locale_list,
            "fields" => [
                "disabled" => $disabled_fields,
                "hidden" => $hidden_fields
            ],
            "buttons" => [
                "hidden" => [
                    "edit", "enable", "delete", "activate"
                ]
            ],
            "validators" => $validators->formValidationRulesJson()
        ]);   
    }    

    /** 
     * Processes the request to create a new user (from the admin controls).
     * 
     * Processes the request from the user creation form, checking that:
     * 1. The username and email are not already in use;
     * 2. The logged-in user has the necessary permissions to update the posted field(s);
     * 3. The submitted data is valid.
     * This route requires authentication.
     * Request type: POST
     * @see formUserCreate
     */
    public function createUser(){
        $post = $this->_app->request->post();
        
        // Load the request schema
        $requestSchema = new \Fortress\RequestSchema($this->_app->config('schema.path') . "/forms/user-create.json");
        
        // Get the alert message stream
        $ms = $this->_app->alerts; 
        
        // Access-controlled resource
        if (!$this->_app->user->checkAccess('create_account')){
            $ms->addMessageTranslated("danger", "ACCESS_DENIED");
            $this->_app->halt(403);
        }

        // Set up Fortress to process the request
        $rf = new \Fortress\HTTPRequestFortress($ms, $requestSchema, $post);        
  
        // Sanitize data
        $rf->sanitize();
                
        // Validate, and halt on validation errors.
        $error = !$rf->validate(true);
        
        // Get the filtered data
        $data = $rf->data();        
        
        // Remove csrf_token, password confirmation from object data
        $rf->removeFields(['csrf_token, passwordc']);
        
        // Perform desired data transformations on required fields.  Is this a feature we could add to Fortress?
        $data['user_name'] = strtolower(trim($data['user_name']));
        $data['display_name'] = trim($data['display_name']);
        $data['email'] = strtolower(trim($data['email']));
        $data['active'] = 1;
        
        // Check if username or email already exists
        if (UserLoader::exists($data['user_name'], 'user_name')){
            $ms->addMessageTranslated("danger", "ACCOUNT_USERNAME_IN_USE", $data);
            $error = true;
        }

        if (UserLoader::exists($data['email'], 'email')){
            $ms->addMessageTranslated("danger", "ACCOUNT_EMAIL_IN_USE", $data);
            $error = true;
        }
        
        // Halt on any validation errors
        if ($error) {
            $this->_app->halt(400);
        }
    
        // Get default primary group (is_default = GROUP_DEFAULT_PRIMARY)
        $primaryGroup = GroupLoader::fetch(GROUP_DEFAULT_PRIMARY, "is_default");
            
        // Set default values if not specified or not authorized
        if (!isset($data['locale']) || !$this->_app->user->checkAccess("update_account_setting", ["property" => "locale"]))
            $data['locale'] = $this->_app->site->default_locale;
    
        if (!isset($data['title']) || !$this->_app->user->checkAccess("update_account_setting", ["property" => "title"])) {
            // Set default title for new users
            $data['title'] = $primaryGroup->new_user_title;
        }
        
        if (!isset($data['primary_group_id']) || !$this->_app->user->checkAccess("update_account_setting", ["property" => "primary_group_id"])) {
            $data['primary_group_id'] = $primaryGroup->id;
        }
        
        // Set groups to default groups if not specified or not authorized to set groups
        if (!isset($data['groups']) || !$this->_app->user->checkAccess("update_account_setting", ["property" => "groups"])) {
            $default_groups = GroupLoader::fetchAll(GROUP_DEFAULT, "is_default");
            $data['groups'] = [];
            foreach ($default_groups as $group_id => $group){
                $data['groups'][$group_id] = "1";
            }
        }
        
        // Hash password
        $data['password'] = Authentication::hashPassword($data['password']);
        
        // Create the user
        $user = new User($data);

        // Add user to groups, including selected primary group
        $user->addGroup($data['primary_group_id']);
        foreach ($data['groups'] as $group_id => $is_member) {
            if ($is_member == "1"){      
                $user->addGroup($group_id);    
            }
        }
        
        // Store new user to database
        $user->store();        
        
        // Success message
        $ms->addMessageTranslated("success", "ACCOUNT_CREATION_COMPLETE", $data);
    }
    
    /** 
     * Processes the request to update an existing user's details, including enabled/disabled status and activation status.
     * 
     * Processes the request from the user update form, checking that:
     * 1. The target user's new email address, if specified, is not already in use;
     * 2. The logged-in user has the necessary permissions to update the posted field(s);
     * 3. We're not trying to disable the master account;
     * 4. The submitted data is valid.
     * This route requires authentication.
     * Request type: POST
     * @param int $user_id the id of the user to edit.     
     * @see formUserEdit
     */      
    public function updateUser($user_id){
        $post = $this->_app->request->post();
        
        // Load the request schema
        $requestSchema = new \Fortress\RequestSchema($this->_app->config('schema.path') . "/forms/user-update.json");
        
        // Get the alert message stream
        $ms = $this->_app->alerts; 
        
        // Get the target user
        $target_user = UserLoader::fetch($user_id);
        
        // Get the target user's groups
        $groups = $target_user->getGroups();
        
        /*
        // Access control for entire page
        if (!$this->_app->user->checkAccess('uri_update_user')){
            $ms->addMessageTranslated("danger", "ACCESS_DENIED");
            $this->_app->halt(403);
        }
        */
        
        // Only the master account can edit the master account!
        if (($target_user->id == $this->_app->config('user_id_master')) && $this->_app->user->id != $this->_app->config('user_id_master')) {
            $ms->addMessageTranslated("danger", "ACCESS_DENIED");
            $this->_app->halt(403);
        }
                       
        // Remove csrf_token
        unset($post['csrf_token']);
                                
        // Check authorization for submitted fields, if the value has been changed
        foreach ($post as $name => $value) {
            if ($name == "groups" || (isset($target_user->$name) && $post[$name] != $target_user->$name)){
                // Check authorization
                if (!$this->_app->user->checkAccess('update_account_setting', ['user' => $target_user, 'property' => $name])){
                    $ms->addMessageTranslated("danger", "ACCESS_DENIED");
                    $this->_app->halt(403);
                }
            } else if (!isset($target_user->$name)) {
                $ms->addMessageTranslated("danger", "NO_DATA");
                $this->_app->halt(400);
            }
        }

        // Check that we are not disabling the master account
        if (($target_user->id == $this->_app->config('user_id_master')) && isset($post['enabled']) && $post['enabled'] == "0"){
            $ms->addMessageTranslated("danger", "ACCOUNT_DISABLE_MASTER");
            $this->_app->halt(403);
        }

        if (isset($post['email']) && $post['email'] != $target_user->email && UserLoader::exists($post['email'], 'email')){
            $ms->addMessageTranslated("danger", "ACCOUNT_EMAIL_IN_USE", $post);
            $this->_app->halt(400);
        }
        
        // Set up Fortress to process the request
        $rf = new \Fortress\HTTPRequestFortress($ms, $requestSchema, $post);                    
    
        // Sanitize
        $rf->sanitize();
    
        // Validate, and halt on validation errors.
        if (!$rf->validate()) {
            $this->_app->halt(400);
        }   
               
        // Get the filtered data
        $data = $rf->data();
        
        // Update user groups
        if (isset($data['groups'])){
            foreach ($data['groups'] as $group_id => $is_member) {
                if ($is_member == "1" && !isset($groups[$group_id])){
                    $target_user->addGroup($group_id);
                } else if ($is_member == "0" && isset($groups[$group_id])){
                    $target_user->removeGroup($group_id);
                }
            }
            unset($data['groups']);
        }
        
        // Update the user and generate success messages
        foreach ($data as $name => $value){
            if ($value != $target_user->$name){
                $target_user->$name = $value;
                // Custom success messages (optional)
                if ($name == "enabled") {
                    if ($value == "1")
                        $ms->addMessageTranslated("success", "ACCOUNT_ENABLE_SUCCESSFUL", ["user_name" => $target_user->user_name]);
                    else
                        $ms->addMessageTranslated("success", "ACCOUNT_DISABLE_SUCCESSFUL", ["user_name" => $target_user->user_name]);
                }
                if ($name == "active") {
                    $ms->addMessageTranslated("success", "ACCOUNT_MANUALLY_ACTIVATED", ["user_name" => $target_user->user_name]);
                }
            }
        }
        
        $ms->addMessageTranslated("success", "ACCOUNT_DETAILS_UPDATED", ["user_name" => $target_user->user_name]);
        $target_user->store();        
        
    }
    
    /** 
     * Processes the request to delete an existing user.
     * 
     * Deletes the specified user, removing associations with any groups and any user-specific authorization rules.
     * Before doing so, checks that:
     * 1. You are not trying to delete the master account;
     * 2. You have permission to delete user user accounts.
     * This route requires authentication (and should generally be limited to admins or the root user).
     * Request type: POST
     * @param int $user_id the id of the user to delete.     
     */       
    public function deleteUser($user_id){
        $post = $this->_app->request->post();
    
        // Get the target user
        $target_user = UserLoader::fetch($user_id);
    
        // Get the alert message stream
        $ms = $this->_app->alerts;
        
        // Check authorization
        if (!$this->_app->user->checkAccess('delete_account', ['user' => $target_user])){
            $ms->addMessageTranslated("danger", "ACCESS_DENIED");
            $this->_app->halt(403);
        }
                
        // Check that we are not disabling the master account
        if (($target_user->id == $this->_app->config('user_id_master'))){
            $ms->addMessageTranslated("danger", "ACCOUNT_DELETE_MASTER");
            $this->_app->halt(403);
        }

        $ms->addMessageTranslated("success", "ACCOUNT_DELETION_SUCCESSFUL", ["user_name" => $target_user->user_name]);
        $target_user->delete();
        unset($target_user);
    }
    
}
