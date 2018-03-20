<!DOCTYPE html>
<html>
<head>
	<title>
		Inicio Kualimecatrónica
	</title>
	<style type="text/css">
	.sidenav {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 1; /* Stay on top */
    top: 0;
    left: 0;
    background-color: #111; /* Black*/
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 60px; /* Place content 60px from the top */
    transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}
 
/* The navigation menu links */
.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s
}
 
/* When you mouse over the navigation links, change their color */
.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}
 
/* Position and style the close button (top right corner) */
.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}
 
/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
    transition: margin-left .5s;
    padding: 20px;
    overflow:hidden;
    width:100%;
}
body {
  overflow-x: hidden;
}
 
/* Add a black background color to the top navigation */
.topnav {
    background-color: #333;
    overflow: hidden;
}
 
/* Style the links inside the navigation bar */
.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}
 
/* Change the color of links on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}
 
/* Add a color to the active/current link */
.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
 
/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
 
a svg{
  transition:all .5s ease;
 
  &:hover{
    #transform:rotate(180deg);
  }
}
 
#ico{
  display: none;
}
 
.menu{
  background: #000;
  display: none;
  padding: 5px;
  width: 320px;
  @include border-radius(5px);
 
  #transition: all 0.5s ease;
 
  a{
    display: block;
    color: #fff;
    text-align: center;
    padding: 10px 2px;
    margin: 3px 0;
    text-decoration: none;
    background: #444;
 
    &:nth-child(1){
      margin-top: 0;
      @include border-radius(3px 3px 0 0 );
    }
    &:nth-child(5){
      margin-bottom: 0;
      @include border-radius(0 0 3px 3px);
    }
 
    &:hover{
      background: #555;
    }
  }
}
	</style>
</head>
<script>
function openNav() {
    document.getElementById("sideNavigation").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}
 
function closeNav() {
    document.getElementById("sideNavigation").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}
</script>
<body>

<div id="sideNavigation" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Features</a>
  <a href="#">Contact Us</a>
</div>
 
<nav class="topnav">
  <a href="#" onclick="openNav()">
    <svg width="30" height="30" id="icoOpen">
        <path d="M0,5 30,5" stroke="#000" stroke-width="5"/>
        <path d="M0,14 30,14" stroke="#000" stroke-width="5"/>
        <path d="M0,23 30,23" stroke="#000" stroke-width="5"/>
    </svg>
  </a>
</nav>
 
<div id="main">
<!-- Add all your websites page content here  -->
</div>

</body>
</html>