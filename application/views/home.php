<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html ng-app="todolisTApp">

<head>
    <title>ToDo List 2020</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>" />
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/ngAlertify.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <link rel="icon" href="/" type="image/x-icon" />
</head>

<body>

    <header>
        <h1>ToDo List 2020 <small>v1.0.0</small></h1>
        <input type="hidden" ng-init="base='<?php echo base_url(); ?>'" />
        <p>
            <i class="fa fa-magic"></i> A simple <strong> to-do list </strong> Web Application By <small>「ogur」</small>
        </p>
    </header>

    <div id="container" ng-controller="Home">
        <div class="todo-header clearfix js-toggler" data-target="todo-list">
            <div class="todo-count">
                <span>#<strong>{{todos.length}}</strong></span>
            </div>
            <h2>
                <i class="fa fa-navicon"></i> My List
            </h2>
        </div>
        <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input type="text" ng-model="searchText" ng-change="change(text)" placeholder="filter" />
    </div>
        <div class="todo-list js-todo-list">
            <div class="inner">
                <div class="item" ng-repeat="todo in todos">
                    <div class="inner done-{{todo.done}}" >
                        <div class="status">
                        <input type="hidden" ng-model="todoId" id ="{{todo.id}}" />
                       
                        <p>Completed</p>
                        <input type="checkbox" name="someSwitchOption{{todo.id}}" class="toggle" 
                    ng-model="todo.done" status="{{todo.status}}" ng-click="editTog(todo)"
                    id="togle{{todo.id}}" checked>
                    
                        </div>
                        <div class="text">
                            <p>{{todo.text}}</p>
                        </div>
                        <p>{{todo.date}}</p>
                        <div class="clearfix"></div>
                        <div class="options">
                            <span ng-click="show(todo)" class="btn-edit">
                                <i class="fa fa-eye"></i> Show
                            </span>
                            <span ng-click="edit(todo)" class="btn-edit">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                            <span ng-click="remove(todo)" class="btn-edit">
                                <i class="fa fa-remove"></i> Remove
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="todo-form">
            <form ng-submit="add()">
                <div class="input-group">
                    <input type="text" ng-model="todoInput" size="25" placeholder="Add new item.." />
                    <button>
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="dev-notes js-dev-notes hidden">
        <h3># Dev Notes</h3>
        <i class="fa fa-tick"></i> No Issues were reported.
    </div>

    <footer>
        <div class="inner">
            Copyrights &copy; <strong>ogur.uyanik</strong>, 2020
            <br />
            <a href="https://github.com/uyanik13" target="_blank">
                <i class="fa fa-github big"></i> GitHub
            </a>
            |
            <a href="https://twitter.com/oguruyanik" target="_blank">
                <i class="fa fa-twitter big"></i> Twitter
            </a>
            <br /><br /> Created via
            <strong class="js-toggler" data-target="dev-notes">AngularJS<sup>&reg;</sup></strong>
        </div>
    </footer>
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
</body>

</html>