<!DOCTYPE html>
<html lang="en">

@include('rakyat.layout.header');

<body>
  <main id="main">
    @include($data['content'],$data)
  </main><!-- End #main -->

  @include('rakyat.layout.footer')

</body>

</html>
