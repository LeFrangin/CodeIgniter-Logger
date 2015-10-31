# Codeigniter Logging Library

Powerfull logging library that allow for multiple tricks with your logs, rather than the default logging library.

With this library you can choose a custom severity of the log dynamically (not just INFO, DEBUG, ERROR or WARNING), you also can choose the file where you want write the message.
A new functionnality save all your old files into their own zip, each day.


## Configuration

Is very simple to configure this library with Codeigniter. You just have to add all files into your structure and follows these steps

Go to the file **application/config/autoload.php** and add the library logger to the library load by default

` $autoload['libraries'] = array( 'Logger' ); `

## Default

The library is fully configure to display nice log but you can modify all parameters in the file **application/config/logger.php**


## Usage

To use your new logger library, you have to call one function

> $this->logger->write( "your_file", "severity", "your message" );

And the message will display into the log file like that

` Severity - 2015-10-30 21:09:36 --> Your message `