<script>
$(function() {
	var ev=localStorage.getItem('chkm');
	if(ev != '' && ev != null)
	{	
		if(ev != 'empty')
		{
			
			$('#msgs').html(ev);
			$('#pp').click();
			$('#mnotify').show().removeClass('fade');
		}
		else
		{
			$('#error').text('Enter All The Required Fields');
			$('#stud-login').click();
		}
		localStorage.setItem('chkm','');
	}
	/* var cev=localStorage.getItem('cchkm');
	if(cev != '' && cev != null)
	{	
		if(cev != 'empty')
		{
			$('#msgs').html(cev);
			$('#pp').click();
		}		
		localStorage.setItem('cchkm','');
	} */	
	
});
</script>
<script type='text/javascript'>
        var LS_Meta = {
            "v": "6.7.1"
        };
    </script>
    <script data-cfasync="false" type="text/javascript">
        var lsjQuery = jQuery;
    </script>
    <script data-cfasync="false" type="text/javascript">
        lsjQuery(document).ready(function() {
            if (typeof lsjQuery.fn.layerSlider == "undefined") {
                if (window._layerSlider && window._layerSlider.showNotice) {
                    window._layerSlider.showNotice('layerslider_3', 'jquery');
                }
            } else {
                lsjQuery("#layerslider_3").layerSlider({
                    sliderVersion: '6.6.5.1516012254',
                    type: 'fullwidth',
                    skin: 'v6',
                    hoverPrevNext: false,
                    navStartStop: false,
                    navButtons: false,
                    showCircleTimer: false,
                    skinsPath: ''
                });
            }
        });
    </script>    
    <script type='text/javascript'>
        var EikraObj = {
            "stickyMenu": "1",
            "meanWidth": "992",
            "primaryColor": "#002147",
            "seconderyColor": "#fdc800",
            "siteLogo": "",
            "day": "Day",
            "hour": "Hour",
            "minute": "Minute",
            "second": "Second",
            "extraOffset": "70",
            "extraOffsetMobile": "52",
            "rtl": "no"
        };
    </script>    
    <script type="text/javascript" defer src="js/autoptimize.js"></script>