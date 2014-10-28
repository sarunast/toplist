<hr/>
<div class="row" style="padding-bottom: 20px;">
    <div class="col-xs-6">
        <copy class="text-center">TamyTop &copy; 2013</copy>

    </div>
    <div class="col-xs-1"></div>
    <div class="col-xs-6 text-right">
        <a href="{{url('contact')}}" style="padding-right: 15px;">Contact</a>
        <a href="{{url('affiliate')}}" style="padding-right: 15px;">Affiliate</a>
        <a href="{{url('advertise')}}" style="padding-right: 15px;">Advertise</a>
    </div>
</div>
{{ basset_javascripts($website->scripts) }}
<script>
    Socialite.setup({
        facebook: {
            lang     : 'en_GB',
            appId    : 633052990046045
        }
    });
    var socialbuttons = $('div.socialbuttons');
    Socialite.load(socialbuttons[0]);
    if (socialbuttons[1]){
        Socialite.load(socialbuttons[1]);
    }
    $(document).ready(function()
    {


        $('div#parent').livequery(function(){
            var timeout;
            var element;
            $(this).hover(function(){
                element = this;
                timeout = setTimeout(loader, 300);},
                canceler);

            function loader(){
                if ($(element).attr('social')) {
                }else {
                    Socialite.load($(element)[0]);
                    $(element).attr('social', '1');
                }
            }
            function canceler(){
                clearTimeout(timeout);
            }
        });
        $('body').livequery(function(){
            $(this).tooltip({
            selector: '[data-toggle="tooltip"]'
            });
        });
        $("#RegForm").validate({
            rules: {
                password: "required",
                password_confirmation: {
                    equalTo: "#password"
                }
            }
        });
        $("#RegFormNext").validate({
            rules: {
                password: "required",
                password_confirmation: {
                    equalTo: "#password1"
                }
            }
        });
        $("#LoginForm").validate();
        $("#LoginForm1").validate();
        $( "ul#sortable" ).sortable();
        $( "ul#sortable" ).disableSelection();
    });
</script>
</body>
</html>