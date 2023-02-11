<h1>Login</h1>
<form action="{{url('register')}}" method="post">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="mobile">Mobile</label>
    <input type="text" name="mobile" id="mobile">
    <label for="email">Email</label>
    <input type="text" name="email" id="email">
    <label for="password">Password</label>
    <input type="text" name="password" id="password">

    <input type="submit" value="Register">
</form>
