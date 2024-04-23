<x-layout pageTitle=" Tasks Todo - Editar">
    <x-slot:btn>
      <a href="{{route('home')}}" class="btn btn-primary">
            Voltar
      </a>
    </x-slot:btn>
   <section class="task_section">
       <h1>Editar Tarefa</h1>
       <form action="{{route('task.edit_action')}}" method="POST">
          @csrf
          <input type="hidden" name="id" value={{$task->id}}>
          <x-form.checkbox name="is_done" type="checkbox" label="Tarefa Realizada?" checked="{{$task->is_done}}"/>
          <x-form.text_input name="title"  label="Titulo" placeholder="Digite o titulo da sua tarefa" required='required' :value="$task->title"/>
          <x-form.text_input type="datetime-local" name="due_date" id="due_date"  label=" Data de Realização:" :value="$task->due_date" />
          <x-form.select_input name="category_id" id="category" label="Categoria:">
            @foreach ($categories as $category)
             <option value="{{$category->id}}"
                @if($category->id === $task->category_id)
                 selected
                @endif
             >
                {{$category->title}}
            </option>
            @endforeach
          </x-form.select_input>
          <x-form.textarea_input name="description" id="description" label="Descrição:" placeholder="Digite sua descrição" :value="$task->description" />
          <x-form.form_button submitText="Atualizar" resetText="Resetar" />
       </form>
   </section>
</x-layout>


