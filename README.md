# Codeigniter Logging Library

Powerfull logging library that allow for multiple tricks with your logs, rather than the default logging library.

With this library you can choose a custom severity of the log dynamically (not just INFO, DEBUG, ERROR or WARNING), you also can choose the file where you want write the message.
A new functionnality save all your old files into their own zip, each day. The file will get your custom name and the date => **your_name_file-2015-10-16.zip**

The purpose of this library is to provide good log library able to write and store.


## Configuration

Is very simple to configure this library with Codeigniter. You just have to add all files into your structure and follows the next step

Go to the file **application/config/autoload.php** and add the library logger to the library load by default

` $autoload['libraries'] = array( 'Logger' ); `

## Default

The library is fully configure to display nice log but you can modify all parameters in the file **application/config/logger.php**


## Usage

To use your new logger library, you have to call one function

`$this->logger->write( "name_of_log_file", "severity", "your message" ); `

And the message will display into the log file like that

` Severity - 2015-10-30 21:09:36 --> Your message `

## Zip functionnality

To use the zip, you have to call the following line into a crontab for example and all your old log files will automatically zip **your_name_file-2015-10-16.zip**

` $this->logger->zip() `