<x-layout pageTitle=" Tasks Todo - Create">
    <x-slot:btn>
      <a href="{{route('home')}}" class="btn btn-primary">
            Voltar
      </a>
    </x-slot:btn>
   <section class="task_section">
       <h1>Criar Tarefa</h1>
       <form action="{{route('task.create_action')}}" method="POST">
          @csrf
          <x-form.text_input name="title"  label="Titulo" id="title" placeholder="Digite o titulo da sua tarefa" required='required' />
          <x-form.text_input type="datetime-local" name="due_date" id="due_date"  label=" Data de Realização:" />
          <x-form.select_input name="category_id" id="category" label="Categoria:">
            @foreach ($categories as $category)
             <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
          </x-form.select_input>
          <x-form.textarea_input name="description" id="description" label="Descrição:" placeholder="Digite sua descrição" />
          <x-form.form_button submitText="Gravar" resetText="Resetar" />
       </form>
   </section>
   <script type="module" src="/assets/js/script.js"></script>
</x-layout>

