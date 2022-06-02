<x-header componentName="John" />
<div class="container">
    <h1> Hello {{ $name }} </h1>
    <p> 
        Current Time: <b>{{now()}}</b>. 
        <br>
        The current UNIX timestamp is <b>{{ time() }}</b>.
    </p>

    <b>Session :</b> {{$sessionValue}}
    <br><br>

    <b>Result by isset and if()else()</b><br>
    @isset($name)

        @if ($name === "john")
            Name match..! <b> {{$name}} </b>
        @else
            Name not matched. Please check again..! {{$name}}
        @endif
        
    @endisset
    <br><br>

    <b> Result by foreach() </b><br>
    @foreach ($users as $user)
        This is user {{ $user }}<br>
    @endforeach



</div>