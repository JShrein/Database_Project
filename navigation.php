<ul class="navigation">
	<li class="nav-item" <?php if ($thisPage=="Index") echo " id=\"currentpage\""; ?>>
		<a href="index.php">Log In</a>
	</li>
	<li class="nav-item" <?php if ($thisPage=="Registration") echo " id=\"currentpage\""; ?>>
		<a href="registration.php">Registration</a>
	</li>
	<li class="nav-item" <?php if ($thisPage=="Home") echo " id=\"currentpage\""; ?>>
		<a href="home.php">Home</a>
	</li>
	<li class="nav-item" <?php if ($thisPage=="Users") echo " id=\"currentpage\""; ?>>
		<a href="users.php">Users</a>
	</li>
	<li class="nav-item" <?php if ($thisPage=="Search") echo " id=\"currentpage\""; ?>>
		<a href="search.php">Search</a>
	</li>
</ul>

<input type="checkbox" id="nav-trigger" class="nav-trigger" />
<label for="nav-trigger"></label>