<?php

namespace UserFrosting;

/**
 * GroupController Class
 *
 * Controller class for /groups/* URLs.  Handles group-related activities, including listing groups, CRUD for groups, etc.
 *
 * @package UserFrosting
 * @author Alex Weissman
 * @link http://www.userfrosting.com/navigating/#structure
 */
class GroupController extends \UserFrosting\BaseController {

    /**
     * Create a new GroupController object.
     *
     * @param UserFrosting $app The main UserFrosting app.
     */
    public function __construct($app){
        $this->_app = $app;
    }

    /**
     * Renders the group listing page.
     *
     * This page renders a table of user groups, with dropdown menus for modifying those groups.
     * This page requires authentication (and should generally be limited to admins or the root user).
     * Request type: GET
     * @todo implement interface to modify authorization hooks and permissions
     */    
    public function pageGroups(){
        // Access-controlled page
        if (!$this->_app->user->checkAccess('uri_groups')){
            $this->_app->notFound();
        }
        
        $groups = GroupLoader::fetchAll();
        
        $this->_app->render('groups.html', [
            'page' => [
                'author' =>         $this->_app->site->author,
                'title' =>          "Groups",
                'description' =>    "Group management, authorization rules, add/remove groups, etc.",
                'alerts' =>         $this->_app->alerts->getAndClearMessages()
            ],
            "groups" => $groups
        ]);          
    }    

    /**
     * Renders the form for creating a new group.
     *
     * This does NOT render a complete page.  Instead, it renders the HTML for the form, which can be embedded in other pages.
     * The form can be rendered in "modal" (for popup) or "panel" mode, depending on the value of the GET parameter `render`
     * This page requires authentication (and should generally be limited to admins or the root user).
     * Request type: GET
     */      
    public function formGroupCreate(){
        // Access-controlled resource
        if (!$this->_app->user->checkAccess('create_group')){
            $this->_app->notFound();
        }
        
        $get = $this->_app->request->get();
        
        if (isset($get['render']))
            $render = $get['render'];
        else
            $render = "modal";
        
        // Get a list of all themes
        $theme_list = $this->_app->site->getThemes();
        
        // Set default values
        $data['is_default'] = "0";
        // Set default title for new users
        $data['new_user_title'] = "New User";
        // Set default theme
        $data['theme'] = "default";
        // Set default icon
        $data['icon'] = "fa fa-user";
        // Set default landing page
        $data['landing_page'] = "dashboard";
        
        // Create a dummy Group to prepopulate fields
        $group = new Group($data);                
        
        if ($render == "modal")
            $template = "components/group-info-modal.html";
        else
            $template = "components/group-info-panel.html";
        
        // Determine authorized fields
        $fields = ['name', 'new_user_title', 'landing_page', 'theme', 'is_default', 'icon'];
        $show_fields = [];
        $disabled_fields = [];
        foreach ($fields as $field){
            if ($this->_app->user->checkAccess("update_group_setting", ["property" => $field]))
                $show_fields[] = $field;
            else
                $disabled_fields[] = $field;
        }
        
        // Load validator rules
        $schema = new \Fortress\RequestSchema($this->_app->config('schema.path') . "/forms/group-create.json");
        $validators = new \Fortress\ClientSideValidator($schema, $this->_app->translator);           
        
        $this->_app->render($template, [
            "box_id" => $get['box_id'],
            "box_title" => "New Group",
            "submit_button" => "Create group",
            "form_action" => $this->_app->site->uri['public'] . "/groups",
            "group" => $group,
            "themes" => $theme_list,
            "fields" => [
                "disabled" => $disabled_fields,
                "hidden" => []
            ],
            "buttons" => [
                "hidden" => [
                    "edit", "delete"
                ]
            ],
            "validators" => $validators->formValidationRulesJson()
        ]);   
    }            
    
    /**
     * Renders the form for editing an existing group.
     *
     * This does NOT render a complete page.  Instead, it renders the HTML for the form, which can be embedded in other pages.
     * The form can be rendered in "modal" (for popup) or "panel" mode, depending on the value of the GET parameter `render`.
     * Any fields that the user does not have permission to modify will be automatically disabled.     
     * This page requires authentication (and should generally be limited to admins or the root user).
     * Request type: GET
     * @param int $group_id the id of the group to edit.
     */       
    public function formGroupEdit($group_id){
        // Access-controlled resource
        if (!$this->_app->user->checkAccess('uri_groups')){
            $this->_app->notFound();
        }
        
        $get = $this->_app->request->get();
        
        if (isset($get['render']))
            $render = $get['render'];
        else
            $render = "modal";
        
        // Get the group to edit
        $group = GroupLoader::fetch($group_id);
        
        // Get a list of all themes
        $theme_list = $this->_app->site->getThemes();
        
        if ($render == "modal")
            $template = "components/group-info-modal.html";
        else
            $template = "components/group-info-panel.html";
        
        // Determine authorized fields
        $fields = ['name', 'new_user_title', 'landing_page', 'theme', 'is_default'];
        $show_fields = [];
        $disabled_fields = [];
        $hidden_fields = [];
        foreach ($fields as $field){
            if ($this->_app->user->checkAccess("update_group_setting", ["property" => $field]))
                $show_fields[] = $field;
            else if ($this->_app->user->checkAccess("view_group_setting", ["property" => $field]))
                $disabled_fields[] = $field;
            else
                $hidden_fields[] = $field;
        }
        
        // Load validator rules
        $schema = new \Fortress\RequestSchema($this->_app->config('schema.path') . "/forms/group-update.json");
        $validators = new \Fortress\ClientSideValidator($schema, $this->_app->translator);          
        
        $this->_app->render($template, [
            "box_id" => $get['box_id'],
            "box_title" => "Edit Group",
            "submit_button" => "Update group",
            "form_action" => $this->_app->site->uri['public'] . "/groups/g/$group_id",
            "group" => $group,
            "themes" => $theme_list,
            "fields" => [
                "disabled" => $disabled_fields,
                "hidden" => $hidden_fields
            ],
            "buttons" => [
                "hidden" => [
                    "edit", "delete"
                ]
            ],
            "validators" => $validators->formValidationRulesJson()
        ]);   
    }
    
    /** 
     * Processes the request to create a new group.
     * 
     * Processes the request from the group creation form, checking that:
     * 1. The group name is not already in use;
     * 2. The user has the necessary permissions to update the posted field(s);
     * 3. The submitted data is valid.
     * This route requires authentication (and should generally be limited to admins or the root user).
     * Request type: POST
     * @see formGroupCreate
     */
    public function createGroup(){
        $post = $this->_app->request->post();
        
        // DEBUG: view posted data
        //error_log(print_r($post, true));
        
        // Load the request schema
        $requestSchema = new \Fortress\RequestSchema($this->_app->config('schema.path') . "/forms/group-create.json");
        
        // Get the alert message stream
        $ms = $this->_app->alerts; 
        
        // Access-controlled resource
        if (!$this->_app->user->checkAccess('create_group')){
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
        
        // Remove csrf_token from object data
        $rf->removeFields(['csrf_token']);
        
        // Perform desired data transformations on required fields. 
        $data['name'] = trim($data['name']);
        $data['new_user_title'] = trim($data['new_user_title']);
        $data['landing_page'] = strtolower(trim($data['landing_page']));
        $data['theme'] = strtolower(trim($data['theme']));
        $data['can_delete'] = 1;
        
        // Check if group name already exists
        if (GroupLoader::exists($data['name'], 'name')){
            $ms->addMessageTranslated("danger", "GROUP_NAME_IN_USE", $post);
            $error = true;
        }
        
        // Halt on any validation errors
        if ($error) {
            $this->_app->halt(400);
        }
    
        // Set default values if not specified or not authorized
        if (!isset($data['theme']) || !$this->_app->user->checkAccess("update_group_setting", ["property" => "theme"]))
            $data['theme'] = "default";
    
        if (!isset($data['new_user_title']) || !$this->_app->user->checkAccess("update_group_setting", ["property" => "new_user_title"])) {
            // Set default title for new users
            $data['new_user_title'] = "New User";
        }
        
        if (!isset($data['landing_page']) || !$this->_app->user->checkAccess("update_group_setting", ["property" => "landing_page"])) {
            $data['landing_page'] = "dashboard";
        }
        
        if (!isset($data['icon']) || !$this->_app->user->checkAccess("update_group_setting", ["property" => "icon"])) {
            $data['icon'] = "fa fa-user";
        }

        if (!isset($data['is_default']) || !$this->_app->user->checkAccess("update_group_setting", ["property" => "is_default"])) {
            $data['is_default'] = "0";
        }
        
        // Create the group
        $group = new Group($data);
        
        // Store new group to database
        $group->store();        
        
        // Success message
        $ms->addMessageTranslated("success", "GROUP_CREATION_SUCCESSFUL", $data);
    }
        
    /** 
     * Processes the request to update an existing group's details.
     * 
     * Processes the request from the group update form, checking that:
     * 1. The group name is not already in use;
     * 2. The user has the necessary permissions to update the posted field(s);
     * 3. The submitted data is valid.
     * This route requires authentication (and should generally be limited to admins or the root user).
     * Request type: POST
     * @param int $group_id the id of the group to edit.     
     * @see formGroupEdit
     */    
    public function updateGroup($group_id){
        $post = $this->_app->request->post();
        
        // DEBUG: view posted data
        //error_log(print_r($post, true));
        
        // Load the request schema
        $requestSchema = new \Fortress\RequestSchema($this->_app->config('schema.path') . "/forms/group-update.json");
        
        // Get the alert message stream
        $ms = $this->_app->alerts; 
        
        // Get the target group
        $group = GroupLoader::fetch($group_id);
        
        // If desired, put route-level authorization check here
        
        // Remove csrf_token
        unset($post['csrf_token']);
                                
        // Check authorization for submitted fields, if the value has been changed
        foreach ($post as $name => $value) {
            if (isset($group->$name) && $post[$name] != $group->$name){
                // Check authorization
                if (!$this->_app->user->checkAccess('update_group_setting', ['group' => $group, 'property' => $name])){
                    $ms->addMessageTranslated("danger", "ACCESS_DENIED");
                    $this->_app->halt(403);
                }
            } else if (!isset($group->$name)) {
                $ms->addMessageTranslated("danger", "NO_DATA");
                $this->_app->halt(400);
            }
        }
        
        // Check that name is not already in use
        if (isset($post['name']) && $post['name'] != $group->name && GroupLoader::exists($post['name'], 'name')){
            $ms->addMessageTranslated("danger", "GROUP_NAME_IN_USE", $post);
            $this->_app->halt(400);
        }
        
        // TODO: validate landing page route, theme, icon?
        
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
        
        // Update the group and generate success messages
        foreach ($data as $name => $value){
            if ($value != $group->$name){
                $group->$name = $value;
                // Add any custom success messages here
            }
        }
        
        $ms->addMessageTranslated("success", "GROUP_UPDATE", ["name" => $group->name]);
        $group->store();        
        
    }
    
    /** 
     * Processes the request to delete an existing group.
     * 
     * Deletes the specified group, removing associations with any users and any group-specific authorization rules.
     * Before doing so, checks that:
     * 1. The group is deleteable (as specified in the `can_delete` column in the database);
     * 2. The group is not currently set as the default primary group;
     * 3. The submitted data is valid.
     * This route requires authentication (and should generally be limited to admins or the root user).
     * Request type: POST
     * @param int $group_id the id of the group to delete.     
     */     
    public function deleteGroup($group_id){
        $post = $this->_app->request->post();
    
        // Get the target group
        $group = GroupLoader::fetch($group_id);
    
        // Get the alert message stream
        $ms = $this->_app->alerts;
        
        // Check authorization
        if (!$this->_app->user->checkAccess('delete_group', ['group' => $group])){
            $ms->addMessageTranslated("danger", "ACCESS_DENIED");
            $this->_app->halt(403);
        }
                
        // Check that we are allowed to delete this group
        if ($group->can_delete == "0"){
            $ms->addMessageTranslated("danger", "CANNOT_DELETE_GROUP", ["name" => $group->name]);
            $this->_app->halt(403);
        }

        // Do not allow deletion if this group is currently set as the default primary group
        if ($group->is_default == GROUP_DEFAULT_PRIMARY){
            $ms->addMessageTranslated("danger", "GROUP_CANNOT_DELETE_DEFAULT_PRIMARY", ["name" => $group->name]);
            $this->_app->halt(403);
        }
        
        $ms->addMessageTranslated("success", "GROUP_DELETION_SUCCESSFUL", ["name" => $group->name]);
        $group->delete();       // TODO: implement Group function
        unset($group);
    }
        
}
