<?php
    ob_start();// Turns on output buffering 
    /**
     * ob_start() waits until all of the php is executed before outputting it to the page.
     * PHP is a server site language and it executes before the page is even loaded.
     * 
     * ob_start() starts output buffering, which means that any data that should be sent to the browser or client
     * is temporarily held in a buffer instead of being sent immediately.
     * this allows you to manipulate the data before it is sent, or to completely discard it, without affecting any previously sent headers or content.
     * 
     * For example, you might use ob_start() to capture the output of a PHP script into a variable, like this:
     * ob_start();
     * echo "Hello, world!";
     * $output = ob_get_clean();
     * 
     * in this example, the ob_start() function buffering the output. The echo statement sends the string "Hello, world!" to the buffer.
     * The ob_get_clean() function retrieves the contents of the buffer and clears it, assigning the value to the $output variable.
     */
    
    // by default a session will last until after the browser is closed
    // can be used to check whether the user is logged in or not
    // if the user is logged in the session is set and when not logged in then the session is not set
    /**
     * session_start() creates a session or resumes the current one based on a session identifier passed via a GET or POST request,
     * or passed via a cooie. When session_start() is called or when a session auto starts, PHP will call the open and read session 
     * save handlers.
     */
    // start new or resume existing session
    session_start();

    /**
     * Sets the default timezone used by all date/time functions in a script
     */
    date_default_timezone_set("Europe/Zurich");

    try {
        // PDO, php data object
        $con = new PDO("mysql:dbname=bestflix;host=localhost", "root", "");
        
        // we're accessing static attribute on the PDO class called ATTR_ERRMODE
        // we're setting the Error reporting of the database
        // below, we're setting the ATTR_ERRORMODE with ERRMODE_WARNING value
        // outputs any errors for us and continue with the rest of the script
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (PDOException $e) {
        /**
         * our catch block will be listening for any variable of type PDOException
         * PDOException is a class.
         * the variable e will be an instance of the PDOException
         * 
         */
        exit("Connection failed: ".$e->getMessage());
    }
?>