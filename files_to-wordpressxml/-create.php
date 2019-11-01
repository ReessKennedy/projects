<?php 

$myfeed = new RSSFeed(); 
$myfeed->SetChannel('"http://test.r1j7x.com/', 
          'This is my web site', 
          'The latest files in my directory', 
          'en-us', 
          'mysite.com', 
          'mysite.com', 
          'The Latest Files in my Directory'); 
// $myfeed->SetImage('http://www.mysite.com/mylogo.jpg'); 

// Open the current directory (or specify it) and grab only .gif and .jpg files ... 
$dir = opendir ("./"); 
while (false !== ($file = readdir($dir))) {
	if (strpos($file, '.gif',1)||strpos($file, '.jpg',1)||strpos($file, '.png',1)||strpos($file, '.jpeg',1)||strpos($file, '.PNG',1)||strpos($file, '.GIF',1)||strpos($file, '.pdf',1) ) {
		$pubDate = date("D, j M Y H:i:s O", filemtime($file));
		$postDate = date("Y-m-d H:i:s", filemtime($file));
		$myfeed->SetItem("$file", "This is file: $file", "", $pubDate, $postDate);
	}
}

// Output the XML File ... you could write it to the directory instead. 
echo $myfeed->output(); 

class RSSFeed { 
// VARIABLES 
    // channel vars 
    var $channel_url; 
    var $channel_title; 
    var $channel_description; 
    var $channel_lang; 
    var $channel_copyright; 
    var $channel_date; 
    var $channel_creator; 
    var $channel_subject;    
    // image 
    var $image_url; 
    // items 
    var $items = array(); 
    var $nritems; 
     
// FUNCTIONS 
    // constructor 
    function RSSFeed() { 
         $this->nritems=0; 
        $this->channel_url=''; 
        $this->channel_title=''; 
        $this->channel_description=''; 
        $this->channel_lang=''; 
        $this->channel_copyright=''; 
        $this->channel_date=''; 
        $this->channel_creator=''; 
        $this->channel_subject=''; 
        $this->image_url=''; 
    }    
    // set channel vars 
    function SetChannel($url, $title, $description, $lang, $copyright, $creator, $subject) { 
        $this->channel_url=$url; 
        $this->channel_title=$title; 
        $this->channel_description=$description; 
        $this->channel_lang=$lang; 
        $this->channel_copyright=$copyright; 
        $this->channel_date=date("Y-m-d").'T'.date("H:i:s").'+01:00'; 
        $this->channel_creator=$creator; 
        $this->channel_subject=$subject; 
    } 
    // set image 
    function SetImage($url) { 
        $this->image_url=$url;   
    } 
    // set item 
    function SetItem($url, $title, $description, $pubDate, $postDate) { 
        $this->items[$this->nritems]['url']=$url; 
        $this->items[$this->nritems]['title']=$title; 
        $this->items[$this->nritems]['pubdate']=$pubDate; 
        $this->items[$this->nritems]['postdate']=$postDate;
        $this->items[$this->nritems]['description']=$description; 
        $this->nritems++;    
    } 
    // output feed 
    function Output() { 
        $output =  '<?xml version="1.0" encoding="UTF-8" ?>'."\n"; 
        $output .= '<rss version="2.0"
	xmlns:excerpt="http://wordpress.org/export/1.1/excerpt/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:wp="http://wordpress.org/export/1.1/"
>'."\n"; 
        $output .= '<channel>'."\n"; 
        $output .= '<title>testdb</title>'."\n"; 
        $output .= '<link>http://test.r1j7x.com</link>'."\n"; 
        $output .= '<description>Just another WordPress site</description>'."\n"; 
        $output .= '<pubDate>Sat, 16 Apr 2011 15:05:32 +0000</pubDate>'."\n"; 
        $output .= '<language>en</language>'."\n"; 
        $output .= '<wp:wxr_version>1.1</wp:wxr_version>'."\n"; 
        $output .= '<wp:base_site_url>http://test.r1j7x.com</wp:base_site_url>'."\n"; 
        $output .= '<wp:base_blog_url>http://test.r1j7x.com</wp:base_blog_url>'."\n"; 
        $output .= '<wp:author><wp:author_id>1</wp:author_id><wp:author_login>kennedrw</wp:author_login><wp:author_email>rwk@rootofsite.com</wp:author_email><wp:author_display_name><![CDATA[kennedrw]]></wp:author_display_name><wp:author_first_name><![CDATA[]]></wp:author_first_name><wp:author_last_name><![CDATA[]]></wp:author_last_name></wp:author>'."\n"; 
		
		 $output .= '<wp:category><wp:term_id>1</wp:term_id><wp:category_nicename>uncategorized</wp:category_nicename><wp:category_parent></wp:category_parent><wp:cat_name><![CDATA[Uncategorized]]></wp:cat_name></wp:category>'."\n"; 
	 //$output .= '<wp:category><wp:term_id>5</wp:term_id><wp:category_nicename>years</wp:category_nicename><wp:category_parent></wp:category_parent><wp:cat_name><![CDATA[Years]]></wp:cat_name></wp:category>'."\n"; 
	 //$output .= '<wp:category><wp:term_id>4</wp:term_id><wp:category_nicename>2008</wp:category_nicename><wp:category_parent>years</wp:category_parent><wp:cat_name><![CDATA[2008]]></wp:cat_name></wp:category>'."\n"; 
	//$output .= '<wp:category><wp:term_id></wp:term_id><wp:category_nicename>2009</wp:category_nicename><wp:category_parent>years</wp:category_parent><wp:cat_name><![CDATA[2009]]></wp:cat_name></wp:category>'."\n"; 
	 //$output .= '<wp:category><wp:term_id></wp:term_id><wp:category_nicename>2010</wp:category_nicename><wp:category_parent>years</wp:category_parent><wp:cat_name><![CDATA[2010]]></wp:cat_name></wp:category>'."\n"; 
	 //$output .= '<wp:tag><wp:term_id>3</wp:term_id><wp:tag_slug>2008</wp:tag_slug><wp:tag_name><![CDATA[2008]]></wp:tag_name></wp:tag>'."\n"; 
		
		$output .= '<generator>http://wordpress.org/?v=3.1</generator>'."\n"; 





        //$output .= '<items>'."\n"; 
        //$output .= '<rdf:Seq>'; 
        //for($k=0; $k<$this->nritems; $k++) { 
          //  $output .= '<rdf:li rdf:resource="'.$this->items[$k]['url'].'"/>'."\n";  
        //};     
        //$output .= '</rdf:Seq>'."\n"; 
        //$output .= '</items>'."\n"; 
        //$output .= '<image rdf:resource="'.$this->image_url.'"/>'."\n"; 
        //$output .= '</channel>'."\n"; 
        
        
        for($k=0; $k<$this->nritems; $k++) { 
            $output .= '<item>'."\n"; 
       
       
       //$output .= '<title>'.$this->items[$k]['title'].'</title>'."\n"; 
       
       
       
       
       
       
       	$output .= '<title>'.$this->items[$k]['url'].'</title>'."\n"; 
	$output .= '<link>http://test.r1j7x.com/?p=86</link>'."\n"; 
	//$output .= '<pubDate>Sat, 16 Apr 2011 15:03:04 +0000</pubDate>'."\n"; 
	$output .= '<pubDate>'.$this->items[$k]['pubdate'].'</pubDate>'."\n"; 
	$output .= '<dc:creator>kennedrw</dc:creator>'."\n"; 
	//$output .= '<guid isPermaLink="false">http://test.r1j7x.com/?p=86</guid>'."\n"; 
	$output .= '<description></description>'."\n"; 
	$output .= '<content:encoded><![CDATA['.$this->items[$k]['url'].']]></content:encoded>'."\n"; 
	$output .= '<excerpt:encoded><![CDATA[]]></excerpt:encoded>'."\n"; 
	//$output .= '<wp:post_id>86</wp:post_id>'."\n"; 
	$output .= '<wp:post_date>'.$this->items[$k]['postdate'].'</wp:post_date>'."\n"; 
	$output .= '<wp:post_date_gmt></wp:post_date_gmt>'."\n"; 
	$output .= '<wp:comment_status>open</wp:comment_status>'."\n"; 
	$output .= '<wp:ping_status>open</wp:ping_status>'."\n"; 
	$output .= '<wp:post_name>'.$this->items[$k]['url'].'</wp:post_name>'."\n"; 
	$output .= '<wp:status>publish</wp:status>'."\n"; 
	$output .= '<wp:post_parent>0</wp:post_parent>'."\n"; 
	$output .= '<wp:menu_order>0</wp:menu_order>'."\n"; 
	$output .= '<wp:post_type>post</wp:post_type>'."\n"; 
	$output .= '<wp:post_password></wp:post_password>'."\n"; 
	$output .= '<wp:is_sticky>0</wp:is_sticky>'."\n"; 
	$output .= '<category domain="post_tag" nicename="2009"><![CDATA[2009]]></category>'."\n";
	$output .= '<category domain="post_tag" nicename="private"><![CDATA[private]]></category>'."\n";
	//$output .= '<category domain="post_tag" nicename="webdesign"><![CDATA[webdesign]]></category>'."\n"; 
	$output .= '<category domain="category" nicename="2009"><![CDATA[2009]]></category>'."\n"; 
	$output .= '<category domain="category" nicename="2009text"><![CDATA[2009text]]></category>'."\n"; 
	//$output .= '<category domain="category" nicename="2010webdesign"><![CDATA[2010webdesign]]></category>'."\n"; 
	$output .= '<wp:postmeta>'."\n"; 
	$output .= '<wp:meta_key>_thumbnail_id</wp:meta_key>'."\n"; 
	$output .= '<wp:meta_value><![CDATA[88]]></wp:meta_value>'."\n"; 
	$output .= '</wp:postmeta>'."\n"; 
	$output .= '<wp:postmeta>'."\n"; 
	$output .= '<wp:meta_key>imageurl</wp:meta_key>'."\n"; 
	$output .= '<wp:meta_value><![CDATA['.$this->items[$k]['url'].']]></wp:meta_value>'."\n"; 
	$output .= '</wp:postmeta>'."\n"; 
	$output .= '<wp:postmeta>'."\n"; 
	$output .= '<wp:meta_key>_edit_last</wp:meta_key>'."\n"; 
	$output .= '<wp:meta_value><![CDATA[1]]></wp:meta_value>'."\n"; 
	$output .= '</wp:postmeta>'."\n"; 
       
       
       
       $output .= '</item>'."\n";   
       
       
       
       
       }; 
        $output .= '</channel>'."\n"; 
         $output .= '</rss>'."\n"; 
        return $output; 
    } 
}; 

?>