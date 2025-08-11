
<hr class="hide" />
							</div>
						</div>
						<div id="leftColumn">
							<div class="inside">

<!--- left column begin -->

<div class="vnav">


<h3>General</h3>
<ul>
	<li>
	<a href="index.php?func=settings" title="Edit System Settings">Settings</a>
	</li></ul>

<h3>Catagories</h3>
	<ul>
	
	<li>
	<a href="index.php?func=addcat" title="Add A Catagory">Add Catagory</a>
	
	</li>
		<li>
	<a href="index.php?func=managecats" title="Manage Catagories">Manage Catagories</a>
	
	</li>
	</ul>
	
	<h3>Articles</h3>
	<ul>
	<li>
	<a href="index.php?func=addarticle" title="Add An Article">Add Article</a>
	</li>
	
		<li>
	<a href="index.php?func=manage" title="Manage current articles">Manage Articles</a>
	</li></ul>
	<h3>Misc</h3>
	<ul>
			<li>
	<a href="index.php?func=glossary" title="Manage Glossary">Manage Glossary</a>
	</li>
	
		<li>
	<a href="index.php?func=links" title="Manage External Links">Manage Links</a>
	</li>
	</ul>
	
	<h3>Skinning</h3>
	<ul>
		<li>
	<a href="index.php?func=css" title="CSS Editor">CSS Editor</a>
	</li>
		<li>
	<a href="index.php?func=templates" title="Template Editor">Template Editor</a>
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

<p>
<a href="index.php" title="Admin Area Home">Admin Area Home</a></p>
<p>
<a href="../index.php" title="Article System Home">Article System Home</a>
</p>

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
<a href="../index.php?func=rules" style="color: #ded" title="Rules + Guidelines">Rules</a>
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
	</body>
</html>

