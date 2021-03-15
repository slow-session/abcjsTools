"use strict";

const abcNotation = (function () {

    function displayABCmusic(wrapperID, abcText) {
        // create the DOM elements
        let uniqid = Date.now().toString(16);
        let textareaID = `abc-textarea-${uniqid}`
        let paperID = `abc-paper-${uniqid}`

        let wrapper = document.getElementById(wrapperID);
	
        var abcTextarea = document.createElement("TEXTAREA");
        abcTextarea.id = textareaID;
        abcTextarea.style.display = 'block';
        wrapper.appendChild(abcTextarea);

        var paperDiv = document.createElement("DIV");
        paperDiv.id = paperID;
	paperDiv.class = "abc-paper abcjs-tune-number-0"
        wrapper.appendChild(paperDiv);
        
        // load the ABC into the textarea
        document.getElementById(textareaID).innerHTML = abcText.replace(/\x01/g,"\n");
 
        // Draw the dots with the player
        let abcEditor = new window.ABCJS.Editor(textareaID, {
            paper_id: paperID,
            warnings_id: "warnings",
            render_options: {
                responsive: 'resize'
            },
            indicate_changed: "true",
        });
    }

    function displayABCplayer(wrapperID, abcText) {
        // create the DOM elements
        let uniqid = Date.now().toString(16);
        let textareaID = `abc-textarea-${uniqid}`
        let paperID = `abc-paper-${uniqid}`
        let audioID = `abc-audio-${uniqid}`

        let wrapper = document.getElementById(wrapperID);
	
        var abcTextarea = document.createElement("TEXTAREA");
        abcTextarea.id = textareaID;
        abcTextarea.style.display = 'none';
        wrapper.appendChild(abcTextarea);

        var paperDiv = document.createElement("DIV");
        paperDiv.id = paperID;
	paperDiv.class = "abc-paper abcjs-tune-number-0";
        wrapper.appendChild(paperDiv);
        
        let audioDiv = document.createElement("DIV");
        audioDiv.id = audioID;
        wrapper.appendChild(audioDiv);

        // load the ABC into the textarea
        document.getElementById(textareaID).innerHTML = abcText.replace(/\x01/g,"\n");
 
        // Draw the dots with the player
        let abcEditor = new window.ABCJS.Editor(textareaID, {
            paper_id: paperID,
            warnings_id: "warnings",
            render_options: {
                responsive: 'resize'
            },
            indicate_changed: "true",
            synth: {
                el: `#${audioID}`,
                options: {
                    displayLoop: false,
                    displayRestart: true,
                    displayPlay: true,
                    displayProgress: true,
                    displayWarp: true
                }
            }
        });
    }

    function displayABCeditor(wrapperID, abcText) {
        // create the DOM elements
        let uniqid = Date.now().toString(16);
        let textareaID = `abc-textarea-${uniqid}`
        let paperID = `abc-paper-${uniqid}`
        let audioID = `abc-audio-${uniqid}`

        let wrapper = document.getElementById(wrapperID);
	
        var paperDiv = document.createElement("DIV");
        paperDiv.id = paperID;
	    paperDiv.class = "abc-paper abcjs-tune-number-0";
        wrapper.appendChild(paperDiv);
        
        let audioDiv = document.createElement("DIV");
        audioDiv.id = audioID;
        wrapper.appendChild(audioDiv);

        var abcTextarea = document.createElement("TEXTAREA");
        abcTextarea.id = textareaID;
        abcTextarea.style.display = 'block';
        abcTextarea.rows = 13;
        abcTextarea.placeholder = "Or type your ABC here...";
        wrapper.appendChild(abcTextarea);

        /*
        <textarea name='abc' id="textAreaABC" class="abcText" aria-label="textarea ABC" rows="13" spellcheck="false" placeholder="Or type your ABC here..."></textarea>
        */
       
        // load the ABC into the textarea
        document.getElementById(textareaID).innerHTML = abcText.replace(/\x01/g,"\n");
 
        // Draw the dots with the player
        let abcEditor = new window.ABCJS.Editor(textareaID, {
            paper_id: paperID,
            warnings_id: "warnings",
            render_options: {
                responsive: 'resize'
            },
            indicate_changed: "true",
            synth: {
                el: `#${audioID}`,
                options: {
                    displayLoop: false,
                    displayRestart: true,
                    displayPlay: true,
                    displayProgress: true,
                    displayWarp: true
                }
            }
        });
    }

    return {
        displayABCmusic: displayABCmusic,
	    displayABCplayer: displayABCplayer,
        displayABCeditor: displayABCeditor,
    };
})();

if (typeof module !== "undefined" && module.exports) {
    module.exports = abcNotation;
}