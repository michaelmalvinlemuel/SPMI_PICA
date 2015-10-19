(function () {

  angular.module('app')
    .directive('stats',function() {
        return {
            templateUrl:'app/components/stats/stats.html',
            restrict:'E',
            replace:true,
            scope: {
                'model': '=',
                'comments': '@',
                'number': '@',
                'name': '@',
                'colour': '@',
                'details':'@',
                'type':'@',
                'goto':'@'
            }
        
        }
    })

})()

