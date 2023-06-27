<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Hello world
</body>
</html>

<script>
    console.log(window)
    (async function () {
        const response = await window.axios.post('/api/equipment')
        console.log(response)
    })()
</script>
