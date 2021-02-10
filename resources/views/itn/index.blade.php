@extends('page')

@section('title', 'Test')

@section('content')
    <form id="itnForm" action="{{ route('itn.check') }}" method="post">
        @csrf
        <label>
            <span>Input ITN</span>
            <input type="text" name="itn">
        </label>
        <input type="submit">
    </form>
    <div id="answer">

    </div>
    @push('script')
        <script>
            window.onload = () => {
                document.getElementById('itnForm').addEventListener('submit', function (event) {
                    event.preventDefault();

                    axios.post('{{ route('itn.check') }}', new FormData(this))
                        .then((res) => {
                            let answer = document.getElementById('answer');
                            answer.innerText = res.data.message;

                            setTimeout(() => {
                                answer.innerText = ''
                            }, 3000)
                        })
                        .catch((err) => {
                            let answer = document.getElementById('answer');
                            answer.innerText = err.response.data.errors.itn[0];

                            setTimeout(() => {
                                answer.innerText = ''
                            }, 3000)
                        })
                });
            }
        </script>
    @endpush
@endsection
