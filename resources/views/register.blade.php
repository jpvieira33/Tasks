<x-layout pageTitle=" Tasks Todo - Registro">
    <x-slot:btn>
      <a href="{{route('login')}}" class="btn btn-primary">
            Voltar
      </a>
    </x-slot:btn>
   <section class="task_section">
       <h1>Registro de Usuário</h1>
        @if($errors->any())
            <ul class="alert alert-error">
                @foreach ($errors->all() as $error)
                   <li class="alert-item">{{$error}}</li>
                @endforeach
            </ul>
        @endif
       <form action="{{route('user.register_action')}}" method="POST">
          @csrf
          <x-form.text_input name="name"  label="Nome:" id="name" placeholder="Seu nome" required='required' />
          <x-form.text_input type="email" name="email" id="email" placeholder="Seu e-mail"  label="E-mail:" />
          <x-form.text_input type="password" name="password" id="password" placeholder="Sua senha"  label="Senha:" />
          <x-form.text_input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme sua senha"  label="Confirme sua senha:" />
          <x-form.form_button submitText="Registrar-se" resetText="Limpar" />
       </form>
   </section>
   <script type="module" src="/assets/js/script.js"></script>
</x-layout>

