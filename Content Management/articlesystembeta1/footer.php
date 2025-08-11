<hr class="hide" />
							</div>
						</div>
						<div id="leftColumn">
							<div class="inside">

<!--- left column begin -->

<div class="vnav">
<?
$result = @mysql_query('SELECT name,id FROM cats');
if (!$result) 
{
	die('<p class="error">Error performing query: '.mysql_error().'</p>');	
}

$cats = '';
while ($row = mysql_fetch_array($result)) 
{
	$row['name'] = htmlentities($row['name']);
	$cats .= "<li><a href='index.php?func=cat&amp;id={$row['id']}' title='Visit Catagory: {$row['name']}'>{$row['name']}</a></li>";
}
?>
	<h3>Catagories</h3>
	<ul>
	
<? echo $cats ?>
	
	</ul>
	
	<h3>Stats</h3>
	<ul>
	
	<li>
	<a href="index.php?func=stats&amp;do=top10commented" title="The top 10 commented articles">Top 10 Commented</a>
	</li>
	
	<li>
	<a href="index.php?func=stats&amp;do=top10viewed" title="The top 10 viewed articles">Top 10 Viewed</a>
	</li>
	
	<li>
	<a href="index.php?func=stats&amp;do=toprated" title="The top 10 rated articles">Top 10 Rated</a>
	</li>
	
	</ul>

		
	<h3>Other</h3>
	<ul>
	
	<li>
	<a href="index.php?func=glossary" title="Glossary">Glossary</a>
	</li>
	
	
	<li>
	<a href="admin" title="Private! Admin Area">Admin Area</a>
	</li>
		
	</ul>
	

</div>

<!--- left column end -->

								<hr class="hide" />
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div id="rightColumn">
						<div class="inside">

<!--- right column begin -->
<?
$result = @mysql_query('SELECT url,name FROM links');
if (!$result) 
{
	die('<p class="error">Error performing query: '.mysql_error().'</p>');	
}

$links = '';
while ($row = mysql_fetch_array($result)) 
{
	$links .= "<li><a href='{$row['url']}' title='Visit {$row['name']}'>{$row['name']}</a></li>";
}
?>

<div class="vnav">
	<h3>External Links</h3>
	<ul>
	<? echo $links; ?>		
	</ul>
	
	<?
	$result = @mysql_query('SELECT id,name FROM articles ORDER BY id DESC LIMIT 0,5');
	if (!$result) 
	{
		die('<p class="error">Error performing query: ' .
		mysql_error() . '</p>');
	}

	$i = 0;
	$latestarticles = '';
	while ($row = mysql_fetch_array($result)) {
		$i++;
		$latestarticles .= "<li><a href='index.php?func=article&amp;id={$row['id']}' title='View Article: {$row['name']}'><strong>{$i}</strong>: {$row['name']}</a></li>";
	}
?>
<h3>Latest Articles</h3>
	<ul>
	<? echo $latestarticles; ?>
	</ul>	
</div>	

<!--- right column end -->

							<hr class="hide" />
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div id="footer" class="inside">

<!-- footer begin -->
<div style="float: right;margin:0;">
<a href="#" title="Back to top" style="color: #ded">Back To Top</a>
<br />
<a href="index.php?func=rules" style="color: #ded" title="Rules + Guidelines">Rules</a>
</div>
<p style="margin:0;">
	EasyArticle Copyright &copy; CJVJ<br />
	This is Beta version 1.0.0 
	<br /><?
	$mtime = explode(' ', microtime());
	$totaltime = $mtime[0] + $mtime[1] - $starttime;
    printf('Page loaded in %.3f seconds', $totaltime); ?>
</p>

<!-- footer end -->

				<hr class="hide" />
			</div>
		</div>
		<script language="javascript" type="text/javascript" src="images/wz_tooltip.js"></script>
	</body>
</html>

