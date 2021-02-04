<template>
  <div class="container mt-3" style="width: 80%; margin-left: 20%">
      <h1>Minhas Tarefas</h1>

        <form-task @new-task="getList()"
        :resultProp="result"
         />

        <task
          v-for="task in tasks"
          :key="task.id"
          :taskProp="task"
          @deleted-task="updateList"
          @updated-task="updateList"
        />
  </div>
</template>

<script>
import FormTask from "./components/FormTask.vue";
import Task from "./components/Task.vue";
import Tasks from "./services/Tasks.js";

export default {
  name: "App",
  components: {
    FormTask,
    Task,
  },
  data() {
    return {
      tasks: [],
      result: {
        error: false,
        message: ''
      }
    };
  },
  mounted() {
    this.getList();
  },
  methods: {
    getList() {
      this.result.error = false;
      this.result.message = '';
      Tasks.getList().then((response) => {
        this.tasks = response.data;
      });
    },
    updateList(payload) {
      if (payload.data === "Tarefa não pode ser encontrada.") {
        this.result.error = true;
        this.result.message = payload.data;
      } else {
        this.result.error = false;
        this.result.message = payload.data;
      }
      this.getList()
    }
  },
};
</script>

<style>
</style>
