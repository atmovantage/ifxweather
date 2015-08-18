# ifxweather
Project to design and develop a web-based application to enable meteorologists to easily compose and publish a weather forecast.

----------
Version 0.10.0 Pre-Alpha (August 18th, 2015):
There have been some BIG changes in this version. iFxWx will be ready for the Alpha release very soon! Here are the latest changes:

    Composer Page
        Spaced the 'submit' and 'reset' buttons so they are on opposite sides of the page, do not overlap on smaller screens
        Automatic dates and times are set as default values for 'publish date' and 'publish time' and for 'forecast start' selections
            Numerical months (ie. 08) convert to conventional names (ie. August)
            Removed the 'th' 'st' 'nd' 'rd' from the end of the days of the month just to be consistent, they're unnecessary
        The local time selection now automatically selects a time based on the current time (Eastern American time zone for now)
            If it's after 8PM and before 5AM then the start time sets as 5AM
            If it's after 5AM then it sets for the next hour (6AM, 7AM, 8AM), whichever comes next
            If it's after 8AM and before 5PM then the start time sets as 5PM
            If it's after 5PM then it sets for the next hour (6PM, 7PM, 8PM), whichever comes next
        0-12hr title is based on the current time
            If the 'valid from' time is set as a morning forecast
                0-12hr title automatically sets for today's day of the week (ie. "Tuesday")
            If the 'valid from' time is set as an evening forecast
                0-12hr title automatically sets for today's day of the week plus the phrase 'Night' (ie. "Tuesday Night")
        0-12hr title will automatically change if the user selects a different forecast start time
            Coded it so that each forecast period will alternate labels based on whatever the user selects for a start time
                For example: If user selects a start time of 7am - 7pm
                    The 0-12hr title (label) will automatically change to '7am - 7pm'
                    The 12-24hr title (label) will automatically change to '7pm - 7am'
                    So on and so forth for the remainder of the forecast periods
        All 0-12hr variables are carried over during form validation so they are not lost if user fails to fill in a require field(s)
        **Made all input fields dual-purpose**
            Each field will check if the form is being validated for submission (POST) or is being loaded for editing (SESSION)
                Eliminates the need for a redundant Editor page just for loading/editing session variables
                Allows the validation of the forecast after editing the forecast
                All variables entered on the original Composer page will re-populate if user hits 'Edit' from the Preview page
    Preview Page
        Testing out a system to bottom-align the wx images without needing to truncate forecast period titles
            Gave all weather images their own CSS class
                display: inline-block
                vertical-align: bottom
                float: none
        Spaced the 'edit' and 'publish' buttons so they are on opposite sides of the page, do not overlap on smaller screens
        Colorized buttons
    Publish Page
        Same css changes to wx images on the preview page documented above
        Colorized button
        The "Make a New Forecast" button will not reset the session
            In a future version I will fix this so that the Composer page is automatically reset
    Editor Page
        **Deprecated**
            Replaced by passing all variables back through the original Composer page by making each field check for an active session
----------
Version 0.9.1 Pre-Alpha (August 17th, 2015):
Update for bug fix:

    Preview and Publish Pages
        Changed CSS for displaying forecast period title due to bug
            inline-block changed to block
                Was not aligned correctly on display
                    Not that noticeable on desktop displays but very obvious on mobile (non-grid view)
					
----------
Version 0.9.0 Pre-Alpha (August 17th, 2015):
Latest updates are detailed below:

    Composer Page
        Reworked the form validation system
            Previous system was flawed and would allow form to be submitted if the last verified variable was filled in, even if the previous required fields were left blank
        New system checks each variable one-by-one
            If any required variable is not filled in 2 things happen
                A message appears at the top of the page in red informing user that all fields highlighted in red are required
                The backgrounds of any required fields are highlighted red if the user left them blank
                    An easier way out would have been to just highlight all required fields at the same time but I wanted it to be more user-friendly by pointing out exactly the fields that were missing.
            After the form is submitted for validation code was added so that any variables that the user entered before are automatically populated in the respective fields.
    Preview and Publish Pages
        Added CSS so that the title of each forecast period (ie. "Monday Night") does not wrap onto more than a single line
            This is a preventative measure to ensure that when multiple columns are used (grid view) each weather image is vertically aligned
            When viewed on a mobile device (non-grid view) vertical alignment is not applicable
			
----------
Version 0.8.2 Pre-Alpha (August 10th, 2015):
PHP code that involved the use of header() also needed to be moved to the top of the HTML file, also caused server errors.
----------
Version 0.8.1 Pre-Alpha (August 10th, 2015):
Fixed session_start() functions that needed to be moved to the top of the HTML file, otherwise it conflicted with the server and threw many ugly errors.

----------
Version 0.8.0 Pre-Alpha (August 10th, 2015):
Please see the latest changes to the iFx Weather product below:

    Composer Page
        Submit button color changed to light green, changes to brighter green on hover
        Added form validation to check if the following fields are empty:
            Forecaster Name
            Station Name
        Added CSS to turn an empty field red after form validation is run
        Added a "session" to the Composer, Preview, Composer Edit and Publish pages in order to pass variables back and forth
            Had to create new "session" variables for each and every input field
        Added a "reset" button on composer page which clears all saved session variables and refreshes the page

    Preview Page (previously called "handler")
        Renamed to "Preview"
        Changed page title and header to reflect this name change
        Added a unique CSS file and linked in the header
        Changed buttons at the bottom of the page
            Removed reset button (moved to the Composer page as it is more logical to be positioned there)
            Added a "publish" button, which will be used in future development
        Added a "session" to this page and Composer page in order to pass variables back and forth
            This is important not only for form validation but also so that a user can go from the Preview page to the Composer page in order to change variables. Without a session all changes would be lost if the user tried to go back to previous page.
    Edit Page (newly created)
        Was running into problems using "sessions"
            Variables from the 1st Composer page could be validated and submitted to the Preview page
                However, if a user tried to go back to make changes all the variables would reset on the Composer page
            If validation was turned off on the Composer page then user could submit to Preview and go back to make changes
                So I ran into the conundrum of either being able to make changes (without losing all previously-entered variables) or validating user input to ensure required fields were no left blank
        Solution was to create a new unique page based on the original Composer template
            Variables from the Preview page are passed to the Edit page using "sessions"
            Form validation is removed on the Edit page
                In theory, all required fields were entered on the original Composer page, otherwise it wouldn't have been sent to the Preview page.
                On the Edit page, when the user finishes making changes and hits submit the form is not checked for missing info
                    Technically, a user could go in and delete required input
                        The plan in the future to avoid this will be to check if the required field is empty and if it is, then set the required variable to the original value when the form was first submitted for edits.
                            This way the user is still able to change required variables, but is prevented from omitting them altogether

    Publish Page (newly created)
        Essentially the same as the Preview page
            Removed the word "Preview" from header
            Removed the Publish and Edit buttons from the bottom
        Eventually buttons to publish the final forecast will be added
        Added a button to return to the Composer page and make a new forecast
		
----------
Version 0.7.0 Pre-Alpha (July 24th, 2015):
The most recent changes and updates are detailed as follows:

    Forecast Composer
        Added unit selection for wind speed
        Added unit selection for precipitation accumulation
        Changed page header from "iFx Weather" to "Forecast Composer" to help identify purpose of the page more easily
        Changed "Station Name" label to "Location Name" since "Station ID" will suffice for verification purposes later on
        Added a new field called "Forecast Start (Valid From)" to be separate from the date published
            This has been added because the date a forecast is published may or may  not correspond to the time/date that the forecast is valid from.
            By allowing user to enter the start time/date separately from the published time/date we can also clearly state on the Output page when the forecast is valid from.
            Included a list of eight time ranges for the 12-hour forecast (5AM/6AM/7AM/8AM and 5PM/6PM/7PM/8PM)
                allows flexibility to account for personal preference and also for changes due to daylight savings time
        Fixed CSS on the Forecast Start field so that blue background is centered properly and also floats (padded) 5px above bottom of container field.
    Forecast Output
        Coded in units for user-selected wind speed
        Coded in units for user-selected precipitation accumulation
        Added a field "Valid From:" at the top header in addition to the "Published:"
        
----------
Version 0.6.0 Pre-Alpha (July 19th, 2015):
Please see the list of recent changes and improvements below:

    Forecast Composer
        Removed custom CSS elements from the header and input into a separate CSS file
        Cleaned up CSS code to ensure it is compliant with current standards
        Removed all references to units of measurement from the labels and input forms (custom choices to be added soon)
        Set the "details" input text area to be 10 rows in height, giving user a bit more room to see what they've typed. Might add more height later depending on feedback.
        User Preferences: Added a new field just above the submit button and under the columns for entering forecast data
            Created a radio button selection form for temperature units either Fahrenheit or Celsius
            Created a radio button selection form for temperature color (blue if low, red if high and black if user selects 'no')
    Forecast Output
        Added code to check and input the user-selected temperature unit
        Added code to check and input the user-selected temperature color and assign the correct color for highs and lows

----------
Version 0.5.0 Pre-Alpha (July 15th, 2015):
Just as a reminder, while iFx Weather is in the "pre-alpha" stages of development this means that the application is not quite to the point where it is ready to be user-tested. Once all the basic elements are in place and the user can actually get a legitimate final product, then this app will enter the "alpha" phase of testing and development. In the "alpha" phase all the code for the app should be complete and theoretically functional. The purpose of the alpha testing is to weed out bugs and get feedback from users on changes that they would like to see in future versions.

As a preliminary goal, I intend to release the "alpha" version when all 6 forecast periods (12 hours each) are coded and the output from which is nicely displayed in the Forecast Output page. Publishing the forecast in the "alpha" version will likely be via printing only. Later versions will include a greater variety of publishing methods.

Here are a list of the changes and updates made in this latest version:

    Forecast Composer Page
        Reduced size of background image to approximately 300KB in order to improve page load time
        Weather descriptions that were previously abbreviated to reduce width of element changed back to full-length
            The width of the drop-down menu has been set to adjust automatically to the width of its container
        Added Javascript to automatically change the value of the "Weather Description" instantly when user makes a selection from the "Weather" drop down menu.
            This will save the user time when entering the weather description. If the default description is sufficient there will be no need to duplicate effort by making the user manually enter the name of the weather that they just selected
            However, if a user wants to change the weather description he/she is free to do so. The default value is just a suggestion based on the weather image they selected from the drop down.
            Ex. User selects "Rain" from the drop down menu. Instantly the text "Rain" is input into the weather description box below the menu. The user then manually changes the description text to "Afternoon Showers."
        Added a "mostly cloudy" and "overcast" option for the General Day and General Night weather selections respectively.
            I had the icon already made for "overcast/mostly cloudy" but for some reason I missed entering it in the code previously.
        Added a checkbox under Precipitation section to allow user to hide the total rain from the forecast page
            This allows user to enter the total rain for verification purposes but omit from published product.
            Having two accumulations, rain and snow, could be confusing and therefore I decided to give the user the option to hide the liquid equivalent total if they so desire.
    Final Product Page
        Removed line breaks from outside PHP lines of code and replaced with built-in paragraph sections instead
            This was done to prevent excess white space between sections if the user didn't enter certain values
                For example, if the precip section and wind section was left blank then there was a huge white space where this information would normally be between the temperature line and the details section.
            By integrating paragraphs within the PHP code instead of using line breaks or paragraphs in the HTML markup, sections that are left blank by the user do not add excess white space to the forecast column
        Grouped sections of information within the same paragraphs
            Sustained wind min/max is now within the same paragraph as wind gusts (if wind gust information has been entered)
            Rain total and snow accumulation have been split into individual paragraphs to avoid confusion if both values are present
        Changed size and style of some elements
            Forecast period heading made bigger
            Weather description made bold
            Probability of Precip made smaller
            Temperature made bigger
            

----------
Version 0.4.0 Pre-Alpha (July 12th, 2015):
A collection of changes have taken place in the last few days. These changes and updates are listed below:

    On the Forecast Composer page:
        The temperature input has been moved high up in the list, now located below the weather description input.
        Adjusted header text and image to be centered and broken into 2 lines rather than one.
        Meta inputs (forecaster name, station ID and name, date and time) split into two levels rather than crammed into a single line.
        Added greyed out placeholder text in each input form
            The greyed out text will disappear as soon as user begins typing
            Placeholder text does not need to be deleted before user can enter their own values (more user-friendly)
        Center-aligned all input forms, associated labels, and placeholders
        Grouped the multiple inputs for precipitation, snow and wind so they are positioned closer together
        Changed first column of inputs from "Day 1" to "0-12 Hours" in order to clarify the duration of the forecast period.
        Trimmed label descriptions to exclude "Day 1" and also to remove units of measurement (will be customizable later).
        A full-width background image was added 18879358884_a473307aae_o
        Styled each section (a.k.a. division) to include a translucent background
        Styled labels to truncate with ellipses if the label length is greater than the width of its parent container (so the label doesn't hang over the edge of the column)
    On the Forecast Output page:
        Added a secondary button that allows user to go back and make changes to existing forecast
        Changed some of the logic used in determining how some outputs are visually displayed
        Changed "inch(es)" to "in." to account for plural and singular situations easier
        Probability of Precip (PoP) has been added to the end of weather description (if PoP > 0%, otherwise left blank)
            Previously PoP was given its own line of text (ex. Chance of precipitation 80%)
            Now PoP is added cleanly to end of weather description (ex. Isolated Showers (10%) )
            
----------
Version 0.3.0 Pre-Alpha (July 2nd, 2015):
The following fixes and changes have been implemented in this latest version 0.3.0 Pre-Alpha:

    Some weather selection names have been abbreviated in order to reduce width of selection menu
    Input field widths in 'Day 1' have been reduced in order to better accommodate future columns
    Static values inside the input fields have been replaced with "placeholder" text
        All input text fields are empty now, this means user won't have to delete the example text before entering legitimate values
        Greyed out placeholder text will still display in empty text fields in order to provide user with examples and guidance
    Replaced "Low range wind speed" description with "min sustained"
    Replaced "High range wind speed" description with "max sustained"
    Replaced "Gusts. Leave blank if none." description with "max gust" (won't be displayed if it is < or = the max sustained value)
    Fixed "Return to Forecast Composer" button so it links to the correct and latest version. Was linking to previous versions accidentally

----------
Version 0.2.0 Pre-Alpha (June 30th, 2015):
Steady progress has been made over the past couple weeks in developing the pre-alpha version of iFxWx. The primary focus thus far has been to get the CSS (custom style sheet) working, make sure the forecast composer is fully responsive (adapts to various screen sizes automatically) and develop a complete input panel for a single forecast period.
The Input Panel

For the standard 3-day forecast template, each forecast period will be a 12-hour time frame. Each forecast period will have an individual input panel with a full set of various weather parameters and variables for the user to fill in. Thus far I have coded the following inputs:

    For the full page:
        Forecaster name
        Station ID
        Station or location name
        Date
        Time
    For the individual forecast periods:
        Forecast period label
        Weather icon selection list
        Weather description label
        Probability of precipitation
        Precipitation total
        Snow accumulation (range min-max)
        Temperature (high or low)
        Wind (range min-max)
        Wind gusts
        Additional details textbox

I think that the above inputs will likely be all that will be needed for a complete forecast to be built. If I am missing anything obvious please let me know in the comments section below.
The Final Template

At this point the final template is also known as the "handler" because it is the page that takes all the inputs from the composer and enters them into a pre-made HTML template. This HTML template is also built on the Skeleton boilerplate CSS which makes it fully responsive, just like the composer. The initial design for the template is to display the forecast periods in vertical columns. In my experience I find it easier to read a forecast from left to right rather than top to bottom. Future versions of iFxWx will likely incorporate a variety of templates and formats to choose from.
The Weather Icons

Part of building a beautiful weather forecast is having decent weather icons to complement the visual component and provide an easier reading experience to the reader. In my opinion simple icons such as partly_cloudy_day are easier and quicker to read and interpret than 3D icons, colored icons and real-life picture icons. In developing iFxWx I was fortunate to find someone who had already designed basic weather icons and was offering them to the public for free personal or commercial use. Alessio Atzeni is a freelance graphic and web designer who produces a wide variety of royalty-free vector icons. The ones I chose to use are part of his Meteocons set. While most of the primary weather conditions were well represented in his set I did find a few missing, mainly mixed precip icons. A little work with Photoshop using the templates already provided and I am now able to offer a full list of 35 weather icons to choose from. All the icons have been organized into the following categories: General, rain, snow, mixed precip and misc. I decided to organize the list by category to provide more user-friendliness to the forecast builder.
A Little Logic

So far I've coded in a bit of logic into the forecast template. For example, if the probability of precipitation is 0% then on the template page rather than seeing a line saying "0% Chance of Rain" that line is just not displayed. Similar logic has been applied to precip totals, snow accumulation and wind. For the wind, I also have coded in some very rudimentary error-checking. For example, if the user enters a value of min wind that is greater than the max wind, the entire line is not displayed on the forecast template page. Similarly if the wind gusts are less than the wind max range the lines are omitted.

Not displaying faulty data is important. At this point through the error-checking is not very user-friendly and I intend to correct this in future versions. At present, if the user enters faulty data, such as a min wind speed greater than the max wind speed, then the forecaster can still submit the forecast and it will take them to the final template page. However, since the data was faulty, instead of receiving a warning and being given a chance to correct the bad data, the final template will simple not display the line. This is not ideal because the user is left to discover their error on their own, and that can be frustrating and time-consuming. In future versions I will add error-checking to the composer page so that the user is alerted to the error before the page can be successfully submitted.

There are some inputs that are error-checked when the submit button is pressed. Values such as probability of precip and precip totals are value-checked before the submitting the form and will alert the user if a value that was entered falls outside the specified limits (such as entering 102% chance of rain or entering more than 100 inches of rain in a 12-hour period).
Coming Up Next

So now the main task will be to make sure that all the inputs for the forecast period are logical, error-checked and that all variables are accounted for. Once I am satisfied that the first input panel is complete it will be a fairly simple process to duplicate the input panel for the remaining forecast periods. Since this preliminary template is based on a 3-day forecast, and each forecast period is 12 hours long, I will need to create 6 total input panels.

Some further styling may occur as I go along in order to help improve the visual appeal of the forecast template. I am also looking into various ways to publish the final forecast. Printing seems like the easiest method, but I also will be exploring the possibilities of saving it as a PDF, image, CSV file, or sending via email, posting to a blog or sending via SMS text. Some of these methods of publication may be more complex than others so don't hold me to any one in particular. I would be curious to know which method of publication people would prefer to use. Please let me know in the comments section below.

Well, better get back to coding and designing! Stay tuned for more updates and subscribe to this blog to receive updates automatically via email!
----------
Version 0.1.0 Pre-Alpha (May 15th, 2015):
The Very Early Stages

Initial development work for iFxWx is getting underway. The plan for development is to begin with a simple PHP-based web app that will initially be integrated exclusively with this site. In order to build a weather forecast a user will access the Forecast Composer page, fill out the required information and submit it. After hitting "Submit", the user will be brought to a secondary page where all the previously-entered forecast information will be graphically displayed.

I am just entering the pre-alpha phase of development, meaning that the Forecast Composer is far from complete and is not even ready for initial testing. At this stage the focus is on writing the code and designing the HTML templates. I've decided from the start that I want this web app to have a high degree of user-friendliness and therefore I am building the templates on Skeleton which will provide the app with a slick and modern appearance and also will be fully responsive.
Why Build a Responsive Web App?

A responsive web app means that all the elements on the page will automatically adjust depending on the size of the user's screen. This is especially important to allow users to create a weather forecast while on their phone or other mobile device. This may be of particular importance to users that only have access to a single computer screen. The forecasting process can take place on the computer and the user's weather forecast can be composed on their phone or tablet. This eliminates time-consuming and tiresome switching between windows while making your forecast.

Furthermore, if a meteorologist needs to create and send a weather forecast to a client in a hurry, being able to easily compose that forecast from a mobile phone will no doubt be an invaluable tool.
So What's the Next Step?

Well right now I'm focusing on making sure that the code that I write works. I will be building in form validation, such as making sure all required data is entered before submitting, that temperature doesn't exceed three digits, and other common-sense error-checking. As of this post I have developed a template that lets a person enter the day, type of weather, description of weather, temperature and a detailed summary. In the next week I will expand this to include multiple days. I believe I will use a 5-day template as the base from which to start. Other duration forecasts will be developed at a later stage.

The other item I will be working on is a way to "publish" the forecast that a user creates. I have not begun to research this, but my initial intention is to include buttons to either print, email, save as a JPEG or save as a PDF. Since this first version is integrated with my site I am not sure publishing via WordPress will be viable, but I will explore the options.

I personally am very excited to have this project underway. It's been an idea kicking around in my head for quite some time and it feels good to see it slowly materialize. If you would like to stay up-to-date on further developments of iFxWx please subscribe to this blog, as I will continue to post regularly regarding my progress. Thanks for reading, and if you have any suggestions or ideas that you would like to see built into iFxWx please comment below.
