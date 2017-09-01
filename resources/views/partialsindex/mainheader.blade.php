<!-- Main Header -->
<header id="header">
<div class="container">
<div class="row">
	<div class="col-md-3 col-sm-6 col-xs-8">
		<a href="/" class="logo">
		Coin Market Capitalisation
		</a>
	</div>

<button id="nav-trigger"><span></span><span></span><span></span></button>
<div class="col-md-9 col-sm-12">
    <div class="col-md-4">
            <span>Index Market: $ <span id="indexmrk">00.00.00.00 </span></span> <br>
            <span>Index 24h Vol: $ <span id="indexvol24">00.00.00.00 </span></span>
    </div>

    <div class="col-md-8">
    	<nav id="primary-nav" >
    		<ul class="nav nav-pills">
    			<li class="active"><a href="/" title="ALL">Toplist</a></li>
    			<li class=""><a href="/topup" title="Top Up">Top Up</a></li>
    			<li class=""><a href="/topdown" title="Top Down">Top Down</a></li>
    		</ul>
    	</nav> 
    	<script type="text/javascript">
            $('#nav-trigger').on('click', function() {
    		    $('#nav-trigger').toggleClass("open");
    		    $('#primary-nav').toggleClass("open");
    		});
        </script>	
    </div>
</div>
</div>
</div>
</header>
<div id="container-top" class="col-md-12 container-fluid">
            <div class="row">
                <div id="top-nav-inner-container" class="container">
                    <!-- <div class="hidden-xs col-sm-6">
                        <div id="global-stats-counts" class="small">
                        	<ul class="list-inline stat-counters">
                        		<li>Total Market Cap : $112.009.012.933</li>
                        		<li>24h Vol: $4.196.414.442</li>
                        		
                        	</ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div id="global-stats-values" class="small">
                        	<ul class="list-inline stat-counters">
                        		<li>
                        			<span class="apply-overflow-tooltip">EUR/USD</span>
                        			<span class="tsymbol-last">1.11776</span>
                        			<span class="tickerstatus">
                        				<span class="js-symbol-session-status">
                        					0.37%
                        				</span>
                        			</span>
                        		</li>
                            </ul>
                        </div>
                    </div>     -->                
                    
                </div>            
            </div>
</div>