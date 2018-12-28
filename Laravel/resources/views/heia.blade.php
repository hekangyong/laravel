<form action="/places" method="POST">
    {{csrf_field() }}
    <input type="text" name="name">
    <input type="text" name="email">
    <input type="text" name="latitude">
    <input type="text" name="longitude">
    <input type="text" name="x">
    <input type="text" name="y">
    <input type="file" name="fileUpload" />
    <input type="text" name="description">
    <input type="submit" vaule="Create">
</form>