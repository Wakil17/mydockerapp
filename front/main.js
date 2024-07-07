new Vue({
    el: '#app',
    data: {
        newTask: '',
        tasks: []
    },
    methods: {
        loadTasks() {
            axios.get('/backend/api.php?action=getTasks')
                .then(response => {
                    this.tasks = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        addTask() {
            if (this.newTask.trim() === '') return;
            axios.post('/backend/api.php?action=addTask', { description: this.newTask })
                .then(() => {
                    this.newTask = '';
                    this.loadTasks();
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },
    mounted() {
        this.loadTasks();
    }
});

