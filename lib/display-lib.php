<?php
require_once 'users-lib.php';
require_once 'system-lib.php';
// $SITEROOT=$_SERVER['DOCUMENT_ROOT'].'/nsssite/';

function getPublicTopbar()		//only used in template, may be merged.
{
	include 'markup/topbar_public';
}

function getUserTopbar($uid)	//only used in template, may be merged.
{
	if(userIsSiteAdmin())
		include 'markup/topbar_siteadmin.php';
	else if (userIsColgAdmin())
		include 'markup/topbar_colgadmin.php';
	else
		include 'markup/topbar_basic.php';
}

function show_tab_btn()			//generate once and OP to file. -->>PERFORMANCE TODO
{
	$CONN=db_sysconnect();
	$result = mysqli_query($CONN,"SELECT collegename,collegecode FROM colleges ORDER BY collegenum;") or systemlog("SQL query error: ".mysql_error());	//and die?? TODO
	db_sysclose($CONN);
	
	if(mysqli_num_rows($result)!=0)
	{
		while($row = mysqli_fetch_array($result))
		{
			echo "<a class='tab_link' id='".$row['collegecode']."_tab' href='colgmainpage.php?colgcode=$row[collegecode]'>\n"."<div class='tab_btn'>".$row['collegename']."</div>\n"."</a>\n";
		}
	}
}

function excerpt($content)		//Auxillary display function. //gets excerpt; based on presence of <!-- more --> tag.(CKEDITOR wpmore extension)
{
	$pos=strpos($content,"<!--more-->");
	if($pos)
		return substr($content,0,$pos);
	return $content;
}

function getColgPostList($beginaft,$number,$colgcode)		//eg;(0,3,'sxc') gives latest 3 posts from sxc.
{
	$CONN=db_sysconnect();

	$post= mysqli_query($CONN,"SELECT * FROM posts,users,postdata WHERE posts.postid=postdata.postid and posts.authoruid=users.uid and posts.collegecode='$colgcode' ORDER BY pdatetime LIMIT $beginaft,$number;") or systemlog("SQL query error: ".mysql_error());	//and die?? TODO

	db_sysclose($CONN);

	if(mysqli_num_rows($post)!=0)
	{
?>
	<div id='postlist'>
<?php
		while($row=mysqli_fetch_array($post))
		{
?>
		<div class="postlistitem">
			<div class="posttitle">
		<?php
				echo $row['title']
		?>
			</div>
			<span class="authorname">
		<?php
				echo "Author: ".$row['fullname']
		?>
			</span>
			<span class="posttime">
		<?php
				echo $row['posttime'];
		?>
			</span>
			<br/>
			<div class="postexcerpt">
		<?php
				echo excerpt($row['content']);
		?>
			</div>
			<a href="showpost.php?postid=<?php echo $row['postid']; ?>">Read full &#8594; </a>
		</div>
<?php
		}
?>
	</div> <!-- postlist -->
<?php
	}
	else
	{
?>
	<div class="postlistitem">
	No posts found.
	</div>
<?php
	}
}

function totalPosts($collegecode)	//Auxillary display function. //return total number of posts made by a college.
{
	$CONN=db_sysconnect();
	$result = mysqli_query($CONN,"SELECT COUNT(*) as count FROM posts WHERE collegecode='".$collegecode."';") or systemlog("SQL query error: ".mysql_error());	//and die?? TODO
	db_sysclose($CONN);
	
	$result=mysqli_fetch_array($result);
	
	return $result['count'];
}
?>
