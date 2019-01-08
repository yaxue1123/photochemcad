<!DOCTYPE html>
<html>
<head>
    <title>Detail Test Page</title>
    <meta charset="utf-8">
    <link rel="Shortcut Icon" href="./image/PhotochemCADLogo.jpg">
    <link rel="stylesheet" href="./stylesheet/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="./js/echarts.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen|Roboto|Spectral">
    <script>
        // when the DOM is ready, execute the JQuery code
        $(document).ready(function () {
    
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
       
});

</script>
</head>
<body>
<header>
        <div class="logo">
            <h1>PhotochemCAD</h1>
            <h3>calculational modules and a database of absorption and emission spectra for diverse compounds</h3>
        </div>
        <div class="navitems" id="navbar">
        <ul>
                <li>
                    <a href="PhotochemCAD.html">PhotochemCAD™</a>
                </li>
                <li>
                    <a href="homepage.php">Spectra by Name</a>
                </li>
                <li>
                    <a href="structure.php">Spectra by Structure</a>
                </li>
                <li>
                    <a href="download.html">Download</a>
                </li>
                <li>
                    <a href="https://sites.google.com/a/ncsu.edu/lindsey-lab/">Lindsey Lab</a>
                </li>
                <li>
                    <a href="about.html">About</a>
                </li>
            </ul>
        </div>
    </header>
    <div class="main" id="main">
        <aside>
            <h2>Compound Categories</h2>
            <div class = "sidenav">
              <?php 
                require "sidebar.php";
              ?>
            </div>
        </aside>
    <section>
    <div class='detail-body'>
    <div class='compound'>
        <?php
            require "dbconnect.php";
            $name = htmlentities($_GET['name']);
            $query = 'SELECT * FROM records WHERE name = "' . $name . '"';
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    echo "<h1 class='thick' id='name'>" . $row['name'] . "</h1>";
                    echo "<div class='cd-cp'><div class='cd-cp-left'>PhotochemCAD ID: " . $row['id'] . "<p>";
                    echo "Class: " . $row['class'] . "<p>";
                    echo "Name: " . $row['name'] . "<p>";
                    echo "Synonym: " . $row['synonym']. "<p>";
                    echo "CAS: " . $row['cas']. "<p>";
                    echo "Source: <a href='".$row['source_url']."'>" . $row['source'] . "</a><p>";
                    echo 'Structure: <a href="./cdx/'. $row['id'] . '_' . $row['cas'] . '_' . $row['name'] .'.str.cdx" download>' . $row['id'] . '.str.cdx</a><p>';
                    echo "	&#955<sub>abs</sub>: " . $row['wavelength_abs'] . " nm<p></div>";
                    echo '<div class="cd-cp-right"><img src="./image/str/' . $row['id'] . '_' . $row['cas'] . '_' . $row['name'] . '.str_result.png"></div></div>';
        ?>

    </div>
    <div id="spectrum" style="width: 640px;height: 400px;"></div>     
    <div class='absorption-spectrum'>
    <h2>Absorption Spectrum</h2>   
    <?php
                    echo "Solvent: " . $row['solvent_abs'] . "<p>";
                    echo "Instrument: " . $row['instrument_abs'] . "<p>";
                    echo "Date: " . $row['date_abs'] . "<p>";
                    echo "By: " . $row['inv_abs']. "<p>";
                    echo "Absorption coefficient: " . $row['epsilon_abs'] ." at ". $row['wavelength_abs']. " nm<p>";               
        ?>
    </div>
    <div class='fluorescence-spectrum'>
    <h2>Fluorescence Spectrum</h2>
    <?php
                    echo "Solvent: " . $row['solvent_ems'] . "<p>";
                    echo "Instrument: " . $row['instrument_ems'] . "<p>";
                    echo "Date: " . $row['date_ems'] . "<p>";
                    echo "By: " . $row['inv_ems']. "<p>";
                    echo "Fluorescence quantum yield: " . $row['quantum_yield_ems'] . "<p>";
                }
            }
        ?>
    </div>
    <div class='paper'>
    <h2>The data displayed here are derived from the scientific literature. For citations please see the following two papers:</h2>

       <ul>
                <li><a href="https://onlinelibrary.wiley.com/doi/full/10.1111/php.12862">“PhotochemCAD 3: Diverse Modules for Photophysical Calculations with Access to
                    Multiple Spectral Databases,”</a>Taniguchi, M.; Du, H.; Lindsey, J. S. Photochem.
                    Photobiol. <b>2018</b>, 94, 277–289. 
                </li>
                <li><a href="https://onlinelibrary.wiley.com/doi/full/10.1111/php.12860">“Database of Absorption and Fluorescence Spectra of &gt;300 Common Compounds for
                    Use in PhotochemCAD,”</a> Taniguchi, M.; Lindsey, J. S. Photochem. Photobiol. <b>2018</b>, 94,
                    290–327.
                </li>
                </ul>
</div>
    </div>
        </section>
        </div>
        <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
    <footer>
      Copyright © 2004-2018 Jonathan S. Lindsey.
    </footer>
   <script type="text/javascript">
	var myChart = echarts.init(document.getElementById('spectrum'));
    var compound='', wavelength=[], abs=[], ems=[];	
    var name = $("#name").text();
    function TestAjax(){
        $.ajax({
            type: "post",
            async: false,                
            url: "getdata.php",
            data: {name: name},
		    success: function(data){
			if(data){
				for (var i = 0; i < data.length; i++){
				   wavelength.push(data[i].wavelength);
                   abs.push(data[i].abs);
				   ems.push(data[i].ems);
				   compound = data[i].compound;
			}
		}}})};	
        //执行异步请求
        TestAjax();		
        // 指定图表的配置项和数据
        var option = {
	title: {
		text: compound,
		x:'center',
		y:-3,
		textStyle:{fontSize:15}
	},
	toolbox: {
        show : true,
        feature : {
        mark : {show: true},
	    dataZoom: {},
        restore : {show: true},
        saveAsImage : {show: true},
        },
		y:25
    },
	tooltip : {
        trigger: 'axis',
		axisPointer: {
            type: 'shadow',
            label: {
                show: true,
                backgroundColor: '#333'
            }}
    },
	legend:{
		orient: 'horizontal',
		data:['emission','absorption coefficient'],
		x:'left',
		y:30
	},
	dataZoom: [
		{
		 show: true,
		 type:'slider',
		 borderColor: 'transparent',
		 start:0,
		 end:100,
		 bottom:10,
		 backgroundColor: 'rgba(226,226,226,0.2)',
		 height:20,
		 handleIcon: 'path://M306.1,413c0,2.2-1.8,4-4,4h-59.8c-2.2,0-4-1.8-4-4V200.8c0-2.2,1.8-4,4-4h59.8c2.2,0,4,1.8,4,4V413z',
         handleSize: 20,
		 handleStyle: {
            color: '#fff',
            shadowBlur: 6,
            shadowColor: '#aaa',
            shadowOffsetX: 1,
            shadowOffsetY: 2
			   }},
		{
		type:'inside',
		start:0,
		end:100
		}
	],
	grid:{
		show:false,
	},
    xAxis: {
        type: 'category',		
		name:'Wavelength (nm)',
		nameLocation: 'center',
		boundaryGap : false,
		splitLine:{show:true},
		//axisLabel:{interval:499},
		nameGap:'30',
		nameGapY:'30',
		showSymbol:false,
		data: wavelength,
    },
    yAxis: [
		{
        type: 'value',
		name:'Absorption Coefficient',
		nameLocation:'center',
		nameGap:'50',
		nameGapY:'40',
		max:'dataMax',
		splitLine:{show: true},
		//splitNumber:4
    },
		{
		type:'value',
		name:'Emission',
		nameLocation:'center',
		nameGap:'40',
		nameGapY:'40',
		splitLine:{show: false},
		nameRotate:270,
		max:'dataMax'
		}
	],
    series: [
		{
		name:'absorption coefficient',
		showSymbol:false,
		symbol:'circle',
		connectNulls:true,
        data: abs,
        type: 'line',
        smooth: true
    },
	    {
		name:'emission',
		showSymbol:false,
		symbol:'circle',
		connectNulls:true,
		yAxisIndex:1,
		data: ems,
		type: 'line',
        smooth: true
		}
	]	
};
myChart.setOption(option);
</script>
<script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;
       // when the user scrolls the page, execute stick function
       // when the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
          stick();
        };
        // get the navbar and right aside
        var navbar = document.getElementById("navbar");
        var main = document.getElementById("main");
       // get the offset position of the navbar
        var sticky = navbar.offsetTop;
        
        for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
            } else {
            dropdownContent.style.display = "block";
            }
        });
        }

        function stick() {
        // change sticky style for navbar and right aside based on the navbar's position
        if (window.pageYOffset >= sticky) {
            // when the navbar is on the right top, keep navbar and right aside fixed
            navbar.classList.add("sticky");
            main.classList.add("main-margin");
        } else {
            // when the navbar is below the top, un-stick the navbar and right aside
            navbar.classList.remove("sticky");
            main.classList.remove("main-margin");
        }
    }

</script>
</body>
</html>
