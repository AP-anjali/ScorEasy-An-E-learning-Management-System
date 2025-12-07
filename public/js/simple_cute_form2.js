// ============================================================== 1st =================================================================
const yesRadio = document.getElementById('Videos_and_PDFs_access_yes');
const noRadio = document.getElementById('no-label');
const nolabelRadio = document.getElementById('Videos_and_PDFs_access_no');
const limitedLabel = document.getElementById('limited-label');
const limitedLabelRadio = document.getElementById('Videos_and_PDFs_access_limit_limited');
const unlimitedLabel = document.getElementById('unlimited-label');
const unlimitedLabelRadio = document.getElementById('Videos_and_PDFs_access_limit_unlimited');
const limitNumberInput = document.getElementById('limit_number_input');

    if (yesRadio.checked) {
        limitedLabel.style.display = 'inline-block';
        unlimitedLabel.style.display = 'inline-block';
    } else {
        limitedLabel.style.display = 'none';
        unlimitedLabel.style.display = 'none';
        limitNumberInput.style.display = 'none';
    }

    if (nolabelRadio.checked) {
        limitedLabel.style.display = 'none';
        unlimitedLabel.style.display = 'none';
        limitNumberInput.style.display = 'none';
    }

    if (limitedLabelRadio.checked) {
        limitNumberInput.style.display = 'inline-block';
    }

    if (unlimitedLabelRadio.checked) {
        limitNumberInput.style.display = 'none';
    }

    
    // ======================
    yesRadio.addEventListener('change', function() {
        if (this.checked) {
            limitedLabel.style.display = 'inline-block';
            unlimitedLabel.style.display = 'inline-block';
        } else {
            limitedLabel.style.display = 'none';
            unlimitedLabel.style.display = 'none';
            limitNumberInput.style.display = 'none';
        }
    });
    
    nolabelRadio.addEventListener('change', function() {
        if (this.checked) {
            limitedLabel.style.display = 'none';
            unlimitedLabel.style.display = 'none';
            limitNumberInput.style.display = 'none';
        }
    });
    
    limitedLabelRadio.addEventListener('change', function() {
        if (this.checked) {
            limitNumberInput.style.display = 'inline-block';
        }
    });
    
    unlimitedLabelRadio.addEventListener('change', function() {
        if (this.checked) {
            limitNumberInput.style.display = 'none';
        }
    });
    // ======================
// ============================================================== 1st End =================================================================

// ============================================================== 2nd =================================================================
const yesRadio2 = document.getElementById('Download_Videos_and_PDFs_access_yes');
const noRadio2 = document.getElementById('no-label2');
const nolabelRadio2 = document.getElementById('Download_Videos_and_PDFs_access_no');
const limitedLabel2 = document.getElementById('limited-label2');
const limitedLabelRadio2 = document.getElementById('Download_Videos_and_PDFs_access_limit_limited');
const unlimitedLabel2 = document.getElementById('unlimited-label2');
const unlimitedLabelRadio2 = document.getElementById('Download_Videos_and_PDFs_access_limit_unlimited');
const limitNumberInput2 = document.getElementById('limit_number_input2');

    if (yesRadio2.checked) {
        limitedLabel2.style.display = 'inline-block';
        unlimitedLabel2.style.display = 'inline-block';
    } else {
        limitedLabel2.style.display = 'none';
        unlimitedLabel2.style.display = 'none';
        limitNumberInput2.style.display = 'none';
    }

    if (nolabelRadio2.checked) {
        limitedLabel2.style.display = 'none';
        unlimitedLabel2.style.display = 'none';
        limitNumberInput2.style.display = 'none';
    }

    if (limitedLabelRadio2.checked) {
        limitNumberInput2.style.display = 'inline-block';
    }

    if (unlimitedLabelRadio2.checked) {
        limitNumberInput2.style.display = 'none';
    }

    // ==============================
    yesRadio2.addEventListener('change', function() {
        if (this.checked) {
            limitedLabel2.style.display = 'inline-block';
            unlimitedLabel2.style.display = 'inline-block';
        } else {
            limitedLabel2.style.display = 'none';
            unlimitedLabel2.style.display = 'none';
            limitNumberInput2.style.display = 'none';
        }
    });
    
    nolabelRadio2.addEventListener('change', function() {
        if (this.checked) {
            limitedLabel2.style.display = 'none';
            unlimitedLabel2.style.display = 'none';
            limitNumberInput2.style.display = 'none';
        }
    });
    
    limitedLabelRadio2.addEventListener('change', function() {
        if (this.checked) {
            limitNumberInput2.style.display = 'inline-block';
        }
    });
    
    unlimitedLabelRadio2.addEventListener('change', function() {
        if (this.checked) {
            limitNumberInput2.style.display = 'none';
        }
    });
    // ==============================
// ============================================================== 2nd End =================================================================

// ============================================================== 3rd =================================================================
const yesRadio3 = document.getElementById('Exams_access_yes');
const noRadio3 = document.getElementById('no-label3');
const nolabelRadio3 = document.getElementById('Exams_access_no');
const limitedLabel3 = document.getElementById('limited-label3');
const limitedLabelRadio3 = document.getElementById('Exams_access_limit_limited');
const unlimitedLabel3 = document.getElementById('unlimited-label3');
const unlimitedLabelRadio3 = document.getElementById('Exams_access_limit_unlimited');
const limitNumberInput3 = document.getElementById('limit_number_input3');

    if (yesRadio3.checked) {
        limitedLabel3.style.display = 'inline-block';
        unlimitedLabel3.style.display = 'inline-block';
    } else {
        limitedLabel3.style.display = 'none';
        unlimitedLabel3.style.display = 'none';
        limitNumberInput3.style.display = 'none';
    }

    if (nolabelRadio3.checked) {
        limitedLabel3.style.display = 'none';
        unlimitedLabel3.style.display = 'none';
        limitNumberInput3.style.display = 'none';
    }

    if (limitedLabelRadio3.checked) {
        limitNumberInput3.style.display = 'inline-block';
    }

    if (unlimitedLabelRadio3.checked) {
        limitNumberInput3.style.display = 'none';
    }

    // =======================================
    yesRadio3.addEventListener('change', function() {
        if (this.checked) {
            limitedLabel3.style.display = 'inline-block';
            unlimitedLabel3.style.display = 'inline-block';
        } else {
            limitedLabel3.style.display = 'none';
            unlimitedLabel3.style.display = 'none';
            limitNumberInput3.style.display = 'none';
        }
    });
    
    nolabelRadio3.addEventListener('change', function() {
        if (this.checked) {
            limitedLabel3.style.display = 'none';
            unlimitedLabel3.style.display = 'none';
            limitNumberInput3.style.display = 'none';
        }
    });
    
    limitedLabelRadio3.addEventListener('change', function() {
        if (this.checked) {
            limitNumberInput3.style.display = 'inline-block';
        }
    });
    
    unlimitedLabelRadio3.addEventListener('change', function() {
        if (this.checked) {
            limitNumberInput3.style.display = 'none';
        }
    });
    // =======================================
// ============================================================== 3rd End =================================================================