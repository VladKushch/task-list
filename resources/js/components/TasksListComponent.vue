<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="todolist not-done">
                    <h1>Todos</h1>
                    <input type="text" class="form-control add-todo" placeholder="Add todo" v-model="newTask" v-on:keypress.enter="saveTask">
                    <button id="checkAll" class="btn btn-success" v-on:click="finishedAll">Mark all as done</button>

                    <hr>
                    <ul id="sortable" class="list-unstyled">
                        <li class="ui-state-default" v-for="task in tasks" v-if="!task.finished">
                            <div class="checkbox">
                                <input type="checkbox" :id="task.id" :value="task.id"
                                       v-on:click="finished(task.id)">
                                <label :for="task.id">{{task.task}}</label>
                            </div>
                        </li>
                    </ul>
                    <div class="todo-footer">
                        <strong>{{tasksLeft}}</strong> Items Left
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="todolist">
                    <h1>Already Done</h1>
                    <button id="checkAll" class="btn btn-danger" v-on:click="clearAll">Clear All</button>
                    <hr>
                    <ul id="done-items" class="list-unstyled" >
                        <li v-for="task in tasks" v-if="task.finished">
                            <input type="checkbox" :id="task.id" :value="task.id"
                                   v-on:click="finished(task.id)" checked>
                            <label :for="task.id">{{task.task}}</label>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "TasksComponent.vue",
        data: function () {
            return {
                axios: '',
                tasks: [],
                tasksLeft: 0,
                newTask: '',
            }
        },
        created() {
            this.axios = axios.create({
                baseURL:`http://localhost/api/`,
            });
        },
        methods: {
            allTasks: function () {
                this.axios
                    .get('all-tasks')
                    .then(response => (this.tasks = response.data));
            },
            saveTask: function () {
                this.axios
                    .post('save-task', {newTask: this.newTask})
                    .then(response => (this.allTasks()));
                this.newTask = '';
            },
            finished: function (id) {
                this.axios
                    .post('finished-task', {id: id})
                    .then(response => {
                        console.log(response.data);
                        this.allTasks();
                    });
            },
            finishedAll: function () {
                this.axios
                    .post('finished-all-tasks')
                    .then(response => {
                        console.log(response.data);
                        this.allTasks();
                    });
            },
            clearAll: function () {
                this.axios
                    .post('delete-all-finished-tasks')
                    .then(response => {
                        console.log(response.data);
                        this.allTasks();
                    });
            },

        },
        mounted() {
            this.allTasks();
        },
        watch: {
            tasks: function () {
                var count = 0;
                this.tasks.forEach(task => {
                    if (!task.finished) {
                        count++;
                    }
                });
                this.tasksLeft = count;
                count = 0;
            }
        }
    }
</script>

<style scoped>
    body{
        background-color:#EEEEEE;
    }
    .todolist{
        background-color:#FFF;
        padding:20px 20px 10px 20px;
        margin-top:30px;
    }
    .todolist h1{
        margin:0;
        padding-bottom:20px;
        text-align:center;
    }
    .form-control{
        border-radius:0;
    }
    li.ui-state-default{
        padding-top: 10px;
        background:#fff;
        border:none;
        border-bottom:1px solid #ddd;
    }

    li.ui-state-default:last-child{
        border-bottom:none;
    }

    .todo-footer{
        background-color:#F4FCE8;
        margin:0 -20px -10px -20px;
        padding: 10px 20px;
    }
    #done-items li{
        padding:10px 0;
        border-bottom:1px solid #ddd;
        text-decoration:line-through;
    }
    #done-items li label{
        text-decoration:line-through;
    }
    #done-items li:last-child{
        border-bottom:none;
    }
    #checkAll{
        margin-top:10px;
    }
</style>
