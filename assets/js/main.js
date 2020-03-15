/*!
 * ToDo List 2020 v1.0.0
 * Author: uyanik13
 *
 * License: MIT License
 * Copyrights (C) 2020
 */


const app = angular.module('todolisTApp', ['ngAlertify']);


/**
 * App Controller
 */
app.controller('Home', function($scope, $http, $timeout, alertify) {


    alertify
        .delay(2000)
        .success("Welcome Buddy!");


    $scope.todos = [];

    var base_url = window.location.origin;
    var data = {};
    $.ajax({
        url: base_url + "/welcome/getTodos_Json",
        data: data,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            data = response.result;
            data.forEach(function(d) {
                Booleanstatus = (d.status === "1" ? true : false);
                $scope.todos.push({
                    id: d.id,
                    text: d.name,
                    date: d.date,
                    status: d.status,
                    done: Booleanstatus
                })
                $scope.$apply(); //after succes showing the datas
            });

        },
        error: function(response) {
            console.log('error');
        }
    });

    $scope.searchText = null;
    $scope.todos = [];
    $scope.change = function(text) {
        valtosend = $scope.searchText;
        $http.get(base_url + "/welcome/AjaxSearch/" + valtosend)
            .then(function(result) {
                data = result.data;
                $scope.todos = [];
                data.forEach((d) => {
                    Booleanstatus = (d.status === "1" ? true : false);
                    $scope.todos.push({
                        id: d.id,
                        text: d.name,
                        date: d.date,
                        status: d.status,
                        done: Booleanstatus
                    })
                });

            });
    };

    /**
     * Add a New List
     */
    $scope.add = function() {

        const text = $scope.todoInput;
        const date = $scope.todoDate;
        const id = $scope.todoId;


        if (!text)
            return;

        if (alreadyExist(text)) {
            alertify
                .delay(2500)
                .error("Item already exists!");
            return;
        }

        $scope.todoInput = "";
        $scope.todoDate = "";
        $scope.todoId = "";

        $.ajax({
            type: "POST",
            data: { name: text },
            url: base_url + "/welcome/setTodos",
            success: () => {
                alertify.delay(4000).success("succesfully added!");
                $scope.$apply();
                location.reload(true);
            }

        });

        //after succes showing the datas
    };


    /**
     * TEST FUNCTION FOR ITEMS
     *
     */
    $scope.test = function(item) {

        console.log(item);
    }




    $scope.show = function(item) {
        alertify
            .delay(4000)
            .success(item.text + "|" + item.date);
    }


    /**
     * Edit an unfinished item
     *
     * @param {Object} item
     */
    $scope.edit = function(item) {

        if (item.done) {
            // items which are done, are ineditable
            alertify
                .delay(4000)
                .error("Cannot edit already finished items!");
            return;
        }

        const msg = "Editing item: `" + item.text + "`";

        alertify
            .defaultValue(item.text)
            .prompt(msg, function(val, e) {
                if (val === item.text) {

                    alertify
                        .delay(2500)
                        .closeLogOnClick(true)
                        .log("No modification was made.");

                } else if (alreadyExist(val)) {

                    alertify
                        .delay(3000)
                        .error("Item already exists!");

                } else if (val) {

                    item.text = val;
                    $.ajax({
                        type: "POST",
                        data: { name: item.text },
                        url: base_url + "/welcome/updateTodos/" + item.id,
                        success: () => {
                            //console.log(data);
                            alertify.delay(4000).success("Item was successfully Edited!");
                            $scope.$apply();
                            location.reload(true);
                        }

                    });

                    alertify
                        .delay(2000)
                        .success("Item was successfully edited!");

                } else {

                    alertify
                        .delay(3000)
                        .error("Cannot edit your item!");

                }
            });
    };

    $scope.editTog = function(item) {

        $.ajax({
            type: "POST",
            data: { status: (item.done === true ? 1 : 0), name: item.text },
            url: base_url + "/welcome/updateTodosToggle/" + item.id,
            success: () => {
                alertify.delay(4000).success("Item was successfully Edited!");
                $scope.$apply();
                location.reload(true);
            }

        });
    };



    /**
     * *
     * Remove Items
     *
     * @param {Object} item
     */
    $scope.remove = function(item) {
        //const id = $scope.todoId.item;
        var msg = (item.done === true) ?
            "Do you wan to delete this item?" :
            "You are about to remove an unfinished task.\nAre you sure?";

        alertify
            .confirm(msg, function() {

                $.ajax({
                    type: "POST",
                    data: { id: item.id },
                    url: base_url + "/welcome/deleteTodos/" + item.id,
                    success: () => {
                        alertify.delay(4000).success("Item was successfully removed!");
                        $scope.$apply();
                        location.reload(true);
                    }

                });


            }, function() {

                alertify
                    .delay(1500)
                    .log("Operation was canceled.");

            });
    };

    /**
     * Check if an item already exists
     *
     * @param {String} itemText
     * @api private
     */
    function alreadyExist(itemText) {

        const duplicates = $scope
            .todos
            .filter(function(todo) {
                return itemText === todo.text;
            });

        return duplicates.length > 0;
    }
});


const
    HIDDEN = 'hidden',
    TOGGLED = 'toggled';

window.onload = function() {

    var togglers = document
        .querySelectorAll(".js-toggler[data-target]");

    []
    .forEach
        .call(togglers, function(elem) {
            elem.addEventListener('click',
                onJsTogglerClicked,
                false);
        });

}

/**
 * Callback for clicking on a toggler
 *
 * @param {Event} e
 */
function onJsTogglerClicked(e) {

    e.preventDefault();

    var targetName = this
        .getAttribute('data-target');

    var target = document
        .querySelector(".js-" + targetName);

    if (target && target.classList) {
        target.classList.toggle(HIDDEN);
        /*
        OR
        target.style.display = 
            (target.style.display === "none") 
                ? "block" 
                : "none"
        */
        ;
        this.classList.toggle(TOGGLED);
    }

}