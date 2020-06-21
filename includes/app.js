//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.getElementById("pauseButton");

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
pauseButton.addEventListener("click", pauseRecording);

function startRecording() {
	console.log("recordButton clicked");

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
    
    var constraints = { audio: true, video:false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia() 
	*/

	recordButton.disabled = true;
	stopButton.disabled = false;
	pauseButton.disabled = false

	/*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format 
		document.getElementById("formats").innerHTML="Formato: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{numChannels:1})

		//start the recording process
		rec.record()

		console.log("Recording started");

	}).catch(function(err) {
	  	//enable the record button if getUserMedia() fails
    	recordButton.disabled = false;
    	stopButton.disabled = true;
    	pauseButton.disabled = true
	});
}

function pauseRecording(){
	if (rec.recording){
		//pause
		rec.stop();
		pauseButton.innerHTML="Resume";
	}else{
		//resume
		rec.record()
		pauseButton.innerHTML="Pause";

	}
}

function stopRecording() {
	//disable the stop button, enable the record too allow for new recordings
	stopButton.disabled = true;
	recordButton.disabled = false;
	pauseButton.disabled = true;

	//reset button just in case the recording is stopped while paused
	pauseButton.innerHTML="Pause";
	
	//tell the recorder to stop the recording
	rec.stop();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);
}

var index = 1;

function createDownloadLink(blob) {
	let url = URL.createObjectURL(blob);
	// controla o nome do arquivo, nao pode ter caracters nao permitidos como ':' 
	let filename = new Date().toISOString().replace(/[:\.]/g,'');

	let au = document.createElement('audio');
	au.controls = true;
	au.src = url;

	let li = document.createElement('li');
	li.classList = ['list-group-item'];

	li.appendChild(au);

	let id = "send"+index++;

	let form = document.createElement('form');
	form.method='post';
	form.action='javascript:;';

	form.innerHTML = `
	<div class="form-row">
		<div class="col-sm-2">
			<select id="emocao" name="emocao" class='form-control form-control-sm' required>
				<option value="" disabled selected hidden>Emoção</option>
				<option value="1">Felicidade</option>
				<option value="2">Tristeza</option>
				<option value="3">Nojo</option>
				<option value="4">Medo</option>
				<option value="5">Raiva</option>
				<option value="6">Surpresa</option>
				<option value="7">Neutro</option>
				<option value="8">Outro</option>
			</select>
		</div>
		<div class="col">
			<input class="form-control form-control-sm" placeholder="Descrição"
				type="text" name="descricao" id="desc" autocomplete="off">
		</div>
		<div class="col-sm-auto"><input id="${id}" class="btn btn-sm btn-primary" type="submit" value="Enviar ao Banco de Vozes">
		</div>
	</div>
	`;
	
	form.addEventListener('submit', function(event){
		let xhr=new XMLHttpRequest();
		xhr.onload=function(e) {
			 if(this.readyState === 4) {
				  console.log("Server returned: ", e.target);
				  let btn = document.getElementById(id);
				  if( e.target.status == 200){
					  btn.disabled =  true;
					  btn.value = "Enviado!";
				  } else {
					alert('Erro ao enviar o arquivo. \n'+e.target.response)
				  }
					
			 }
		};
		let fd=new FormData(form);
		let perfil = document.perfil;
		if(perfil.reportValidity()){
			fd.append("_token", perfil['_token'].value);
			fd.append("autor", perfil['autor'].value);
			fd.append("idade", perfil['idade'].value);
			fd.append("sexo", perfil['sexo'].value);
			fd.append("audio_data", blob, filename);
			fd.append("filename", filename+".wav");
			xhr.open("POST", "upload", true);
			xhr.send(fd);
		}
 	});

	li.appendChild(form)//add the upload link to li

	console.log(li)
	//add the li element to the ol
	recordingsList.appendChild(li);
}