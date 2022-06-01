<x-header componentName="John" /> 
<div class="container" style="margin-top: 5%;">
    <div class="col-md-12 content">
        <h1>Hi {{ $user->name }}</h1>
        <table class="center">
            <tbody>
                <tr>
                    <td>Id</td>
                    <td><?= $user->id; ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?= $user->name; ?></td>
                </tr> 
                <tr>
                    <td>Email</td>
                    <td><?= $user->email; ?></td>
                </tr> 
                <tr>
                    <td>DOB</td>
                    <td><?= $user->date_of_birth; ?></td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>




