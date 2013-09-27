<p><span style="font-size:16px">This is a php wrapper for the publishers associated with VindowShop.</span></p>

<p><u><strong>1. What does this sdk do?</strong></u></p>

<p>Being a publisher of a content management system and being associated with VindowShop you would like to send your images to VindowShop while posting a blog or some content to your page, and also you would like to show your visitors the VindowShop logo on the those images and help them to get similar cloths from the web. This wrapper helps you to code minimum on your CMS and make these things happen in a easiest way.</p>

<p><br />
<u><strong>2. How does it work?</strong></u></p>

<p>What heppens is basically, we take all the image urls exist in a post while you are posting something. After that we run a selection process to select images from them, then show a tiny VindowShop button on your front end, particularly on those selected images. When ever your user clicks on it, he/she get to see all the similar dresses from different online market places.</p>

<p><u><strong>3. How to use it?</strong></u></p>

<p><strong>Step 1:</strong></p>

<p>Very simple ! Just get this Vindowshop.php file, and keep it whereever you want in your PHP application. Now, where you want to use it just include this file.</p>

<blockquote>
<p>...<br />
required_once(&#39;file/path/Vindowshop.php&#39;);<br />
...</p>
</blockquote>

<p><strong>Step 2:</strong></p>

<p>Now it&#39;s time to get access for your application. Open a developer account at http://developers.vindowshop.com and get your appId and apiKey</p>

<p><strong>Step 3: Authenticate your API</strong></p>

<p>Now get back to your code, and create an instance of the class written at Vindowshop.php (the file you downloaded from us earlier).</p>

<blockquote>
<p>...<br />
$instance = new Vindowshop($appId,$apiKey); // $appId and $apiKey you just recieved from us.<br />
...</p>
</blockquote>

<p>Now you need to authenticate your app before you use it, so..</p>

<blockquote>
<p>...<br />
$instance-&gt;apiAuth();<br />
...</p>
</blockquote>

<p>This generate a token for you, and it keep sending the token to our server every time you made a request. But your token is valid for unused 15 mins, after that you again have to authenticate your app by using the same method. So the best practice is always using $instance-&gt;apiAuth() before you made any action.</p>

<p><strong>Step 4: Sending Images</strong></p>

<p>Make sure you are getting your post content in a variable like $_POST or may be $_GET and after that you store it into your databse. Let&#39;s say you are using $_POST[&#39;content&#39;] to take the html content of a post and let&#39;s assume it may contain images, what you want to let us know about. What you have to do is just, before storing it into your database let us know about the content usinf this:</p>

<blockquote>
<p>...<br />
$instance-&gt;apiAuth();<br />
$instance-&gt;sendImages($_POST[&#39;content&#39;]); // @param is string<br />
...</p>
</blockquote>

<p>That&#39;s it. Now we know about the imagaes you have in your post.</p>

<p><br />
<strong>Step 5: Showing VS logo at the frontend</strong></p>

<p>To do this you need to include some java script and little HTML in your code, what you can do easily and dynamically using this api. What you just need to do is, in your footer section you need add these lines of code.</p>

<blockquote>
<p>...<br />
&lt;!-- footer --&gt;<br />
&lt;!-- After all predefined javascript --&gt;<br />
&lt;?php<br />
required_once(&#39;file/path/Vindowshop.php&#39;);<br />
$instance = new Vindowshop($appId,$apiKey);<br />
$instance-&gt;apiAuth();<br />
echo $instance-&gt;createJS(); // This function will create required DOM for the things get working<br />
?&gt;<br />
...</p>
</blockquote>

<p>Make sure you use it after all your predefined JS required for your website. Best practice is to add it at the bottom of your footer.</p>

<p><strong>Step 6: Few more thing you&#39;d like to know</strong></p>

<p>Know the version of the API</p>

<blockquote>
<p>$instance-&gt;getVersion(); // will give you the version of the API</p>
</blockquote>

<p>&nbsp;</p>

<p><br />
<strong>Step 7: Facing problems or got questions</strong></p>

<p>Drop a mail at sanborn.sen[at]gmail.com</p>

<hr />
<p>&nbsp;</p>
