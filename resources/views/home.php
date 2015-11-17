<!DOCTYPE html>
<html lang="en" ng-app>

<head>
    <title>TaskApp 4 AddApp</title>

</head>

<body ng-controller="TasksController">
<h1 class="col-md-offset-4 title">TaskApp 4 AddApp</h1>

<div class="container col-md-10 col-md-offset-1">


    <h3>Tasks</h3>

    <div class="list-group col-md-12">
        <div ng-repeat="task in tasks | orderBy: 'priority':true ">
            <a href="#" class="col-md-10"
               ng-class="task.completed == true ? 'list-group-item alert-success linethrough' : 'list-group-item'">
                <h4 class="list-group-item-heading">
                    <span ng-if="task.priority" class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    {{ task.title }}
                </h4>

                <p class="list-group-item-text">{{ task.description }}</p>
                <small ng-if="task.completed">Completed: {{ task.updated_at }}</small>
            </a>

            <div class="buttons col-md-2 pull-right">
                <form ng-submit="taskComplete(task)">
                    <button type="submit"
                            ng-class="task.completed == true ? 'btn btn-sm btn-success' : 'btn btn-sm btn-default'">
                        <span class="glyphicon glyphicon-check"></span></button>
                </form>
                <form ng-submit="taskDelete(task)">
                    <button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span>
                    </button>
                </form>

            </div>
        </div>
    </div>

    <hr>
</div>
<form class="col-md-6 col-md-offset-1" ng-submit="addTask()">
    <input type="hidden" name="_token" ng-model="_token" value="<?php echo csrf_token(); ?>">

    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" ng-model="taskTitle">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="3" ng-model="taskDescription"></textarea>
    </div>
    <button type="submit" class="btn btn-warning col-md-12">Add Task</button>
</form>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.29/angular.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<style>
    .linethrough {
        text-decoration: line-through;
    }

    .title {
        font-size: 60px;
    }
</style>
<script>

    function TasksController($scope, $http) {

        getTasks();

        function getTasks() {
            $http.get('/tasks').success(function (tasks) {
                $scope.tasks = tasks;
            });
        }


        $scope.addTask = function () {
            var task =
            {
                title: $scope.taskTitle,
                description: $scope.taskDescription,
                _token: $scope._token
            }
            $http.post('/tasks', task).success(function (task) {
                $scope.tasks.push(task);
                $scope.taskTitle = '';
                $scope.taskDescription = '';
            });

        }

        $scope.taskComplete = function (task) {

            task.completed = task.completed ? false : true;
            $http.put(('/tasks/' + task.id), {completed: task.completed});
        }

        $scope.taskDelete = function (task) {
            $http.delete(('/tasks/' + task.id));
            $scope.tasks.splice($scope.tasks.indexOf(task), 1);
        }


    }
</script>
</html>

