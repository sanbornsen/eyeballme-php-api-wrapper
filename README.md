This is a php wrapper for the publishers associated with VindowShop.

1. What this sdk do?

Being a publisher of a content management system and being associated with VindowShop you would like to send your images to VindowShop while posting a blog or some content to your page, and also you would like to show your visitors the VindowShop logo on the those images and help them to get similar cloths from the web. This wrapper helps you to code minimum on your CMS and make these things happen in a easiest way.


2. How does it work?

What heppens is basically, we take all the image urls exist in a post while you are posting something. After that we run a selection process to select images from them, then show a tiny VindowShop button on your front end, particularly on those selected images. When ever your user clicks on it, he/she get to see all the similar dresses from different online market places.

3. How to use it?

Step 1:

Very simple ! Just get this Vindowshop.php file, and keep it whereever you want in your PHP application. Now, where you want to use it just include this file.
...
required_once('file/path/Vindowshop.php');
...

Step 2:

Now it's time to get access for your application. Open a developer account at http://developers.vindowshop.com and get your appId and apiKey

Step 3: Authenticate your API

Now get back to your code, and create an instance of the class written at Vindowshop.php (the file you downloaded from us earlier).
...
$instance = new Vindowshop('appId','apiKey'); // appId and apiKey you just recieved from us.
...

Now you need to authenticate your app before you use it, so..
...
$instance->apiAuth();
...
This generate a token for you, and it keep sending the token to our server every time you made a request. But your token is valid for unused 15 mins, after that you again have to authenticate your app by using the same method. So the best practice is always using $instance->apiAuth() before you made any action.

Step 4: Sending Images

Make sure you are getting your post content in a variable like $_POST or may be $_GET and after that you store it into your databse. Let's say you are using $_POST['content'] to take the html content of a post and let's assume it may contain images, what you want to let us know about. What you have to do is just, before storing it into your database let us know about the content usinf this:
...
$instance->apiAuth();
$instance->sendImages($_POST['content']); // @param is string 
...

That's it. Now we know about the imagaes you have in your post.


Step 5: Showing VS logo at the frontend

To do this you need to include some java script and little HTML in your code, what you can do easily and dynamically using this api. What you just need to do is, in your footer section you need add these lines of code.

...
<!-- footer -->
<!-- After all predefined javascript -->
<?php 
required_once('file/path/Vindowshop.php');
$instance = new Vindowshop(appId,apiKey);
$instance->apiAuth();
echo $instance->createJS(); // This function will create required DOM for the things get working
?>
...

Make sure you use it after all your predefined JS required for your website. Best practice is to add it at the bottom of your footer.


Step 6: Facing problems or got questions 

Drop a mail at sanborn.sen[at]gmail.com

