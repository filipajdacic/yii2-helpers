Yii2 Helpers - Set of useful helper functions for Yii2
======================================================
This is a set of useful helper function in one place packed to use with Yii2 framework. It will save you a lot of time.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist filipajdacic/yii2-helpers "*"
```

or add

```
"filipajdacic/yii2-helpers": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by putting this in your config:

```php
'components' => array(
    ...
    'Helpers' => array(
        'class' => 'filipajdacic\yii2helpers\Helper',
    ),
    ...
);

```


**Examples:**

 1. **validateEmail()** - Validates email address
 
 ```php
    $email = "example@mail.com";
    $validate = Yii::$app->Helpers->validateEmail($email);
    if($validate) {
       echo 'Mail is Valid!';
    } else {
       echo 'Email is not Valid!';
    }
   ```
   
   
2. **encodeEmail()** - Encodes particular email address into HTML entities so that spam bots do not find it.
 
 ```php
    $email = "example@mail.com";
    $encodedEmail = Yii::$app->Helpers->encode_email($email, 'Contact Me', 'class="emailencoder"');
    
    echo "You can feel free to ".$encodedEmail;
   ```
3. **highlight_text()** - It becomes convenient for user, when he searches something and in the result he can see his keyword highlighted.

   ```php
    $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque condimentum, augue vel finibus suscipit, erat lacus mollis urna, nec placerat nibh ex non felis. Morbi sit amet imperdiet dui. Lorem, Praesent pharetra sed orci in mollis. Pellentesque consectetur, turpis eu imperdiet feugiat, ipsum diam semper libero, eget mollis quam odio ullamcorper ligula. ";
    
    $highlighted_text = Yii::$app->Helpers->highlight_text($text, "Lorem", '#4285F4')
    
    echo'<h2>Your search results for word: <b>Lorem</b> are highlighted:</h2> <Br>';
    echo '<span>'.$highlighted_text.'</span>';
   ```

4. **truncateText()** - You can truncate text and specify number of characters you want to show. It also supports >adding a sufix at the end of the truncated strings (ex: read more..)

   ```php
    
    $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque condimentum, augue vel finibus suscipit, erat lacus mollis urna, nec placerat nibh ex non felis. Morbi sit amet imperdiet dui. Lorem, Praesent pharetra sed orci in mollis. Pellentesque consectetur, turpis eu imperdiet feugiat, ipsum diam semper libero, eget mollis quam odio ullamcorper ligula. ";
    
    $short_version = Yii::$app->Helpers->truncateText($text, 30, ' read more...');
    
    echo '<div id="short_version_news">';
        echo '<span>'.$short_version.'</span>';
    echo '</div>';
   
   ```

5. **cleanText()** - This function clean any text by removing unwanted tags. You can use this function to filter for example an textarea value and strip unwanted tags in text.

 ```php

    $commentBody = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque condimentum, augue vel finibus suscipit, erat lacus mollis urna, nec placerat nibh ex non felis. Morbi sit amet imperdiet dui. <script> alert('I am hacker!'); </script> or <a href='virus.html'>Click here to see my picture </a>' ";
    
    $comment_cleared = Yii::$app->Helpers->clearText($commentBody);
    echo '<div id="news-comment-1">';
        echo '<span>'.$comment_cleared.'</span>';
    echo '</div>';

```


6. **generateSlug();** - This function is useful if you would like to generate clean URL Slug.


```php
    $post_title = "Hey this Helpers will really help you!";
    $url_slug = Yii::$app->Helpers->generateSlug($post_title); 

    echo "<a href='/posts/".$url_slug."'>".$post_title."</a>";
```

7. **getTinyurl();** - Url Shortener using TinyUrl which returns a TinyUrl short URL for provided long URL.

```php
    $raw_url  = "https://github.com/filipajdacic";
    $tiny = Yii::$app->Helpers->getTinyurl($raw_url);
    echo $tiny;
```
8. **base64url_encode();** - Encodes a URL string to a Base64 URL.

```php
    $url = "http://github.com/filipajdacic";
    $encoded_url = Yii::$app->Helpers->base64_encode($url);
    // output will be: aHR0cDovL2dpdGh1Yi5jb20vZmlsaXBhamRhY2lj
```
9. **base64url_decode();** - Decodes a Base64 URL to plain text.

```php
    $url = "aHR0cDovL2dpdGh1Yi5jb20vZmlsaXBhamRhY2lj";
    $decoded_url = Yii::$app->Helpers->base64_decode($url);
    // output will be: http://github.com/filipajdacic
```

10. **timeAgo();** - This function convert a date and time string into xx time ago. Give the data and time string in this format: yyyy-mm-dd hh:ii:ss and it will return you the time ago.

```php
    $post_created_on = "2016-06-11 11:04:32";
    $post_created_on_ago = Yii::$app->Helpers->timeAgo($post_created_on);
    // output will be: 6 months ago
    
    // But if you try like this:
     $post_created_on_ago = Yii::$app->Helpers->timeAgo($post_created_on,true);
    // output will be: 6 months 1 week, 23 hours, 51 minutes, 21 seconds ago
```

11. **showYoutube();** - This function replaces all YouTube link into video object (iframe).

```php
   $youtube_link = "https://www.youtube.com/watch?v=L7oo21yfl7s";
   $youtube_player = Yii::$app->Helpers->showYoutube($youtube_link);
   echo $youtube_player;
```
12. **showVimeo();** - This function replaces all Vimeo link into video object (iframe).

```php
   $vimeo_link = "https://vimeo.com/ondemand/indiegamethemovie/84887593";
   $vimeo_player = Yii::$app->Helpers->showVimeo($vimeo_link);
   echo $vimeo_player;
```

13. **showGravatar();** - Get either a Gravatar URL or complete image tag for a specified email address.

```php
  $email = "ajdasoft@gmail.com";
  $gravatar = Yii::$app->Helpers->showGravatar($email);
  
  echo "<div id="profile_picture">";
   echo "<img src='".$gravatar."'> </img>";
  echo "</div>";
```

14. **showIP();** - This function get real ip address.

```php
    $ip_address = Yii::$app->Helpers->showIP();
    echo "Your IP address is:".$ip_address;
```

15. **qr_code();** - This method can be used to generate a QR Code image.

```php
    $link = "http://github.com/filipajdacic";
    $qr_link = Yii::$app->Helpers->qr_code($link, 'URL');
    
    $email = "ajdasoft@gmail.com";
    $qr_email = Yii::$app->Helpers->qr_code($email, 'EMAIL');
    
    $telephone = "+3816122233331";
    $qr_phone = Yii::$app->Helpers->qr_code($telephone, 'TEL');
    
    $text = "See ya! How are you?";
    $qr_text = Yii::$app->Helpers->qr_code($text, 'TXT');
```

16. **getDistanceBetweenCordinates();** -This method can be used to calculate distance between two coordinates.

```php
    $lat_1 = '44.8014766';
    $long_1 = '20.4516869';
    
    $lat_2 = '44.7188265';
    $long_2 = '21.1762609';
    
    $distance = Yii::$app->Helpers->getDistanceBetweenCoordinates($lat_1, $long_1, $lat_2, $long_2);
    
    foreach ($distance as $unit => $value) {
        echo $unit.': '.number_format($value,4).'<br />';
    }
```

17. **pre_dump();** - Pretty dump.

```php
 
    $data = array("One", "Two", "Three");
    Yii::$app->Helpers->pre_dump($data);

```
### Version
1.0
License
----
MIT