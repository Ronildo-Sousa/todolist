<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-8">

            <div v-if="result.message"
            class="alert mb-3"

            :class="result.error ? 'alert-danger' : 'alert-success'"
          >
          {{ result.message }}
          </div>


          <form @submit.prevent action="" class="form-inline">
            <input
              type="text"
              v-model="task.content"
              class="form-control col-lg-10 mr-3"
              placeholder="Insira sua tarefa"
              autofocus
            />
            <button  :class="(task.content.length > 0 ? 'btn btn-success' : 'btn btn-outline-success')" @click="createTask()">
              <i class="fas fa-plus"></i>
            </button>
          </form>
          <hr />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Tasks from "../services/Tasks.js";

export default {
  name: "FormTask",
  data() {
    return {
      task: {
        content: "",
      },
      result: this.resultProp
    };
  },
  props: {
    resultProp: Object
  },
  methods: {
    createTask() {
     this.result.message = ''
      Tasks.setTask(this.task)
      .then((response) => {
        this.task.content = "";
        if (response.data == "Tarefa não pode estar em branco.") {
          this.result.error = true;
          this.result.message = response.data;
        } else {
          this.result.error = false;
          this.$emit("new-task");
          this.result.message = response.data;
        }
      })
    }
  }
};
</script>

<style scoped>
</style>
