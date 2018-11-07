/* reset styles*/
/*background:#f5ebe1;*/
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn,  font, img, ins, kbd, q, s, samp,
small, strike, sub, sup, tt, var,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-weight: inherit;
	font-style: inherit;
	font-size: 100%;
	font-family: inherit;
}

ol, ul {
	list-style: none;
}
/* tables still need 'cellspacing="0"' in the markup */
table {
	border-collapse: separate;
	border-spacing: 0;
}
caption, th, td {
	text-align: left;
	font-weight: normal;
}
body 
{
	background:#ccccff;
	color:#000000;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11.2px;
	font-size-adjust:none;
	font-stretch:normal;
	font-style:normal;
	font-variant:normal;
	font-weight:normal;
	line-height:18px;
	text-align:center;
}
input{border:solid 1px #acacac;}
a{text-decoration:none; color:#de0649;}
a:hover{ color:#2f9044;}
table.bordered tr, th, td{ border: 0.0px solid #000000; }

/*layout*/
#wrapbg{width:920px; margin:0 auto; background:url(../images/bodybg.jpg);}
#wrap{width:900px; margin:0 10px 0 10px; text-align:left; background:#fff; }
#banner{  }
	#banner #logo{ height:70px;}
	#banner #topnav{ background:#666660; overflow:hidden;}
	#banner #topnav li{float:left; padding:0 ; border-right:solid 1px #FFF;}
	#banner #topnav li.last{ border:none;}
	#banner #topnav li a{float:left; color:#FFF; font-weight:bold; text-transform:uppercase; padding:6px 10px;}
	#banner #topnav li a:hover{color:#FFF; background:#ccccff}
	/*#banner #topnav ul li a.current{color:#FFF; background:#ac4f2e}*/
		
/*slideshow*/
#slideshow{height:239px; }

/*left col*/
#leftcol{width:180px; float:left; margin-right:20px; margin-left:2px; display:inline; margin-bottom:2px; }
	#leftcol .box{border:solid 0.5px #eee;  margin-top:10px; background:url(../images/headerbg.jpg) repeat-x;}
	#leftcol .box h2{border:solid 1px #fff; padding:5px 15px; font-weight:bold; font-size:13px; color:#616364; background:#666666; color:#fff;  }
	#leftcol .box p{padding:15px 15px 15px 15px;}
	#leftcol .box ul {margin:0;}
	#leftcol .box ul li{list-style:none; border-bottom:solid 1px #eee; padding:5px 15px;}
	#leftcol .box ul li.last{border:none;}
	#leftcol .box ul li a{color:#555;}
	#leftcol .box ul li a:hover{color:#333;}
	#leftcol .box ul ul li{border:none; background:url(../images/sidenav.jpg) no-repeat center left;padding:3px 15px 3px 17px;}
/*right col*/
#rightcol{width:575px; float:left;  margin-bottom:15px; margin-top:15px;  overflow:hidden; display:inline; border1:solid 3px; }
#rightcol h1{color:#666666; font-weight:bold; font-size:15px; margin-bottom:15px;}
	#gallery { overflow:hidden; margin-bottom:70px;}
	#gallery ul {  margin:5px 0 0 0; padding:0; }
	#gallery ul li{float:left; margin:0;  text-align:center; width:210px; height:140px;  }
	#gallery ul li div{margin:10px auto; width:160px; height:245px; text-align:left; font-size:10px;}
	#gallery ul li img{margin-bottom:5px;}
#pagination.selected{ font-weight: bold; color: #ccccff}
#ad-block{
display: table-footer-group;
width: 150;
color: #fff;
text-align: center;
vertical-align: middle;
border: 1px solid #ae3433;
background: #7b3535;
}	

/*footer #afa292*/
#footer{clear:both; overflow:hidden; background:#ccccff; padding:10px; color:#000; border:solid 1px #fff; }
#footer #copyright{ float:right;}
#footer ul li{float:left; padding:0px 4px; text-transform:uppercase;}
#footer a{color:#000; font-weight:bold; }
#footer a:hover{color:#FFF;}