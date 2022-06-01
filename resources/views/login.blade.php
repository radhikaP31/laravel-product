<x-header componentName="John" />
<div class="container" style="margin-top: 5%;">
    <div class="col-md-12" style="margin: 5%;">
        <form method="POST" action="/profile">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" value="" />
        </form>
    </div>
</div>



