Funções:
<br> 
tasks/listar -> lista todas as tasks
<br>
tasks/listar/[id] -> apresenta a task do ID especificado
<br>
tasks/deletar/[id] -> deleta a task do ID especificado
<br>
tasks/criar -> cria uma task seguindo o seguinte padrão:
<br>
{
	"task_description": "xxxxxxx",
	"task_date": "YYYY-MM-DD",
	"task_status": "(todo,doing,done)"
}
<br>