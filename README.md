# laravel-twilio-messaging

A simple demo application that uses Laravel and the Twilio SDK to build
a messaging feature into a site. A Laravel Job (SendSms.php) is used to
asynchronously handle the message sending task. A webhook in the Twilio dashboard
is set to post to `/received`, where the application then handles the SMS info and
adds it to the database as if it were sent as a message internally.

## Building
Clone it locally, and then run the following.
```
composer install
yarn install
cp .env.example .env
```
Make sure you update your .env file with the correct database and Twilio SDK
information.

Go into the MessagingController and alter line 38 to include the phone you want
to receive the texts. Now, proceed:

```
php artisan migrate
php artisan serve
```
Viola.

## License
This project is licensed under the MIT License.
