
var myApp = angular.module('myApp', ['infinite-scroll']);

myApp.controller('DemoController', function($scope, Top) {

    $scope.list = new Top();
    $scope.value = 0.2;
    $scope.remove = function () {
        $('#statictop').remove();
    }

    $scope.resetDis = function(id,title,url) {
        reset(id,title,url);
    }
});
myApp.directive('myRepeatDirective', function() {
    return function(scope) {
        if(!scope.item.image){
            scope.item.image = '../default/'+scope.subcategory +'.jpg'
        }
    };
});
// Reddit constructor function to encapsulate HTTP and pagination logic
myApp.factory('Top', function($http,$rootScope) {
    var Top = function() {
        this.items = [];
        this.busy = false;
        this.end = false;
        this.after = 50;
        this.search = '';
    };
    Top.prototype.nextPage = function() {
        if (this.busy) return;
        this.busy = true;
        var url = location.protocol + "//" + location.host + "/data/servers/"+ $rootScope.category +"?number="+this.after+"&search="+this.search;
        $http.get(url).success(function(data) {
            if (data.length == 0) {
                this.busy = true;
                this.end = true;
            }
            else{
                this.after = this.after + data.length;
                for (var i = 0; i < data.length; i++) {
                    this.items.push(data[i]);
                }
                this.busy = false;
            }

        }.bind(this));
    };


    return Top;
});
$("a#resetDisqus").click(function(){
    reset($(this).attr('server-id'),$(this).attr('server-title'),$(this).attr('server-url'));
});
var reset = function(id,name,path){
    DISQUS.reset({
        reload: true,
        config: function () {
            this.page.identifier = id;
            this.page.url = path+"/"+id;
            this.page.title = name;
        }
    });
};
$("#search").click(function () {
    $('html, body').animate({ scrollTop: 160 }, 'normal');
});
$('div#parent').mouseover(function() {
    $(this).find('#child').css('opacity',1);
});
$('div#parent').mouseout(function() {
    $(this).find('#child').css('opacity',0.2);
});

$("select#inputCategoryServer").change(function () {
    var img = $(this).find(":selected").attr("subcategory-image");
    $("span#image").text(img);
    $("span#subname").text($(this).find(":selected").attr("subcategory-name"));
    $("span#vote").text($(this).val());
    $("img#banner").attr("src", "/top-img/"+img+".jpg");
}).trigger('change');