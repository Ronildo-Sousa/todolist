<template>
  <div class="container">
    <div class="row">
      <div class="col-8">
        <div class="task">
         <input type="checkbox"
         :checked="task.status === 'completed'"
          name="complete"
          @click="doneTask()">
        <div style="width: 80%; text-align: center; padding: 5px;">
             <p :class="(task.status === 'completed' ? 'completed' : '')">{{ task.content }}</p>
        </div>
          <div style="width: 15%; display: flex; justify-content: space-between">
            <button class="btn btn-danger btn-sm">
              <i class="fas fa-trash" @click="destroy()"></i>
            </button>
          </div>
        </div>
        <hr>
      </div>
    </div>
  </div>
</template>

<script>
import Tasks from '../services/Tasks.js'

export default {
  name: 'Task',
  props: {
    taskProp: Object
  },
  data(){
    return {
      task: this.taskProp
    }
  },
  methods: {
    destroy(){
      Tasks.destroyTask(this.task.id)
      .then(
        response => {
          this.$emit('deleted-task',response)
        }
      )
    },
    doneTask(){
      if (this.task.status === 'completed') {
        this.task.status = 'pending'
      } else {
        this.task.status = 'completed'
      }
      Tasks.updateTask(this.task)
      .then(response => {
        this.$emit('updated-task', response)
      })
    }
  },
};
</script>

<style scoped>
.task {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.completed {
  text-decoration: line-through;
  color: rgb(150, 146, 146);
}

</style>
