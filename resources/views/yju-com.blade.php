<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>다 놓쳤다 꿀잼이고</h1>    
    <h1><?= isset($greeting)?"{$greeting}":'안뇽' ?></h1>
    <h1><?= $name;?></h1>

    <h1>{{ $greeting ?? '안녕'}}
        {{ $name }}</h1>
        <!-- $greeting or '안녕'   or은 버전상 막힌 듯  -->
        {{-- 이것도 주석이다 주석 알겠냐!
            이 주석처리는 source보기에서도 안보임(프로그래머만 보임)--}}

    @if($itemCount = count($items)) 
        <p>{{$itemCount}}종류의 과일을 판매중</p>
    @else
        <p> 완판 </p>
    @endif
</body>
</html>