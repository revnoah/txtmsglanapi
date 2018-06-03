# TxtMsgLan

TxtMsgLan is a suite of programs that forward text messages to a server on a local area network. This allows a user to connect their cellphone over a work or home wifi connection and access their text messages using a server and client on that network.

## TxtMsgLanApi

TxtMsgLanApi provides the API and data storage functionality of the application. This application is built with Laravel using MySQL for data storage.

[Laravel Installation Instructions](https://laravel.com/docs/5.6)

### Application Components

The application is made up of several components:

* Android application that intercepts SMS broadcasts and forwards them to a user's server, if available
* PHP Laravel application that provides an API and data storage for desktop applications and other appliances
* Client application(s) that are geared to the desktop or other suitable environments

### TxtMsgLanDroid

This is the Android portion of the application. Built in Java with Android Studio, this application allows users to customize the settings. The SMS data is obtained through user permissions and via access to the SMS Manager.

### TxtMsgLanApi

This is the server API portion of the application. Built in Laravel, this application allows users to interact with the API.
Client applications require this API.

### TxtMsgLanGlade

Possible GTK-based application built in Glade.

### TxtMsgLanJava

Possible Java application built in Netbeans.

## About This Project

This project was created by Noah J Stewart after answering text messages on a phone while sitting at a desktop computer. This suite of applications provide the option to view and respond to text messages on a PC without putting copies of those messages in the cloud.

### Hardware Testing

This application has had limited testing. However, the minimum requirements are intentionally kept low.

* Android smart phone running Android version 5.1.1

### License

#### Attribution-NonCommercial - CC BY-NC

This license lets others remix, tweak, and build upon your work non-commercially, and although their new works must also acknowledge you and be non-commercial, they don’t have to license their derivative works on the same terms.

#### Legal Links

[License Deed](https://creativecommons.org/licenses/by-nc/4.0/)

[Legal Code](https://creativecommons.org/licenses/by-nc/4.0/legalcode)
