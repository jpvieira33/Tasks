<x-layout pageTitle=" Tasks Todo - Login">
   <section class="task_section">
       <h1>Login</h1>
        @if($errors->any())
            <ul class="alert alert-error">
                @foreach ($errors->all() as $error)
                   <li class="alert-item">{{$error}}</li>
                @endforeach
            </ul>
        @endif
       <form action="{{route('user.login_action')}}" method="POST">
          @csrf
          <x-form.text_input type="email" name="email" id="email" placeholder="Seu e-mail"  label="E-mail:" />
          <x-form.text_input type="password" name="password" id="password" placeholder="Sua senha"  label="Senha:" />
          <x-form.form_button submitText="Entrar" resetText="Limpar" />
          <a href="{{route('register')}}">Registre-se</a>
       </form>
   </section>
</x-layout>

