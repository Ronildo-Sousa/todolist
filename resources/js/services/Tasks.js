import { http } from './config'

export default {
    getList:() => {
        return http.get('tarefas');
    },
    setTask:(task) => {
        return http.post('tarefa/nova', task)
    },
    updateTask:(task) => {
        return http.put(`tarefa/${task.id}`, task)
    },
    destroyTask:(task) => {
        return http.delete(`tarefa/${task}`)
    }
}
