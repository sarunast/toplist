
$( document ).ready(function() {
    $("select#inputCategoryStatistics").change(function () {
        var id = $(this).val();
        $("div#online").html('');
        $("div#clicks").html('');
        $("div#votes").html('');
        $("div#rank").html('');
        $.getJSON("/data/statistics/"+id ,function(result){

            if(result.length){
                $('div#statsDiv').show();
                $('div#statsInfo').text('');
                createStats(result);


            }else {
                $('div#statsInfo').text('Data is being gathered');
                $('div#statsDiv').hide();
            }
        });
    }).trigger('change');
});
var myApp = angular.module('statsApp', []);

myApp.controller('StatisticsController', function($scope,$http){
    $scope.load = function (id) {
        $http.get('/data/statistics/'+id).success(function(data) {
            if(data.length){
                createStats(data);
            }else {
                $('div#statsInfo').text('There is currently no data');
                $('div#statsDiv').remove();
            }
        });
    }
});
function createStats(result){
    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'online',
        hideHover: 'auto',
        postUnits: '%',
        xLabels: 'day',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: result,
        // The name of the data record attribute that contains x-values.
        xkey: 'created_at',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['up_percent'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Value']

    });
    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'votes',
        hideHover: 'auto',
        xLabels: 'day',

        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: result,
        // The name of the data record attribute that contains x-values.
        xkey: 'created_at',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['votes'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Value']
    });
    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'clicks',
        hideHover: 'auto',
        xLabels: 'day',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: result,
        // The name of the data record attribute that contains x-values.
        xkey: 'created_at',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['clicks'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Value']
    });
    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'rank',
        hideHover: 'auto',
        xLabels: 'day',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: result,
        // The name of the data record attribute that contains x-values.
        xkey: 'created_at',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['rank'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Value']
    });
}