<x-layout>
    <x-slot:userLogged>
        <div class="user-logado">
            <p>Seja bem-vindo</p>
            <div class="avatar">
                <img src=/assets/images/avatar.jpg alt="">
                <div class="name_user"><b> {{$user->name}}</b></div>
            </div>

         </div>
    </x-slot:userLogged>

    <x-slot:btn>
      <a href="{{route('task.create')}}" class="btn btn-primary">
            Criar Tarefa
      </a>

      <a href="{{route('logout')}}" class="btn btn-primary">
        Sair
      </a>
    </x-slot:btn>

    <section class="graph">
        <div class="graph_header">
            <h2>Progesso do dia</h2>
            <div class="graph-header-line"></div>
            <div class="graph_header-date">
               <a href="{{route('home', ['date'=> $date_prev_button])}}" >
                 <img src="/assets/images/icon-prev.png" alt="">
               </a>
                  {{$date_string}}
              <a href="{{route('home', ['date'=> $date_next_button])}}">
                <img src="/assets/images/icon-next.png" alt="">
              </a>
            </div>
        </div>
        <div class="graph_header_subtitle">
            Tarefas: <b>{{$task_isDone}}/{{$task_count}} </b>
        </div>

        <div class="graph-placeholder" id="graph-placeholder">
            <canvas id="myChart"></canvas>
        </div>

        <div class="tasks-left-footer">
            <img src="/assets/images/icon-info.png" alt="">
          Restam {{$task_isDone}} tarefa(s) para serem finalizadas
        </div>
       </section>

       <section class="list">
         <div class="list-header">
            <select class="list-header-select" onchange="changeTaskFilter(this)">
                <option value="all_task">Todas as Tarefas</option>
                <option value="task_pending">Tarefas Pendentes</option>
                <option value="task_done">Tarefas Realizadas</option>
            </select>
         </div>
         <div class="task-list">
            @foreach ($tasks as $task)
             <x-task :data=$task />
            @endforeach
         </div>
       </section>
</x-layout>

<script>
    async function taskUpdate(e){
      let isDone = e.checked;
      let taskId = e.dataset.id;
      let url = '{{route('task.update')}}'

      let response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'accept': 'application/json'
        },
        body: JSON.stringify({isDone, taskId, _token: '{{csrf_token()}}'})
      });

      let result = await response.json();
      result.success ? alert('Task atualizada com sucesso!') : e.checked = !isDone;
      window.location.reload(true);
    }
</script>

<script>
    function changeTaskFilter(e){
        allTasks();

       if(e.value == 'task_pending'){
         document.querySelectorAll('.task_done').forEach(element => {
            element.style.display = 'none'
         });
       }else if(e.value == 'task_done'){

        document.querySelectorAll('.task_pending').forEach(element => {
            element.style.display = 'none'
         });
    }
 }

    function allTasks(){
      document.querySelectorAll('.task').forEach(element => {
        element.style.display = 'flex'
    });
}
</script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Realizadas','Pendentes'],
        datasets: [{
          data: [{{$porcent_isDone}}, {{$porcent_isDoneFalse ?? 0}} ],
          borderWidth: 1,
          backgroundColor: [
            '#6143ff',
            '#f0f2f4']
        }]
      },
    });
  </script>

<script>
 document.querySelectorAll(".sphere").forEach(element => {
    color =  element.dataset.color;
    element.style.backgroundColor = color;
 });

</script>
