var fever = template("fever", "Fever");
var cough = template("cough", "Cough");
var tiredness = template("tiredness", "Tiredness");
var chest_pain = template("chest_pain", "Chest Pain");
var head_ache = template("head_ache", "Head Ache");
var stomach_ache = template("stomach_ache", "Stomach Ache");
var kidney_failure = template("kidney_failure", "Kidney Failure");
var heart_problem = template("heart_problem", "Heart Problem");
var diabetes = template("diabetes", "Diabetes");
var less_oxygen_level = template("less_oxygen_level", "Less Oxygen Level");
var malignancy_cancer = template("malignancy_cancer", "malignancy_cancer");
var hypertension = template("hypertension", "Hypertension");
var liver_disease = template("liver_disease", "Liver Disease");
var immunocompromised_condition = template("immunocompromised_condition", "Immunocompromised Condition");
var vomiting = template("vomiting", "Vomiting");
var consume_steroids = template("consume_steroids", "Consume Steroids");
var sore_throat = template("sore_throat", "Sore Throat");
var diarrhea = template("diarrhea", "Diarrhea");
var congestion = template("congestion", "Congestion");
var sense_loss = template("sense_loss", "Sense Loss");
var skin_rash_discoloration = template("skin_rash_discoloration", "Skin Rash Discoloration");
var trouble_breathing = template("trouble_breathing", "Trouble Breathing");
var contact_positive = template("contact_positive", "Contact Positive");
var is_positive = template("is_positive", "Is Positive");
var is_vaccinated = `<div><label class="col-md-6 radioLabel">Is Vaccinated with 1st Dose:</label><div class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" value="Yes" id="is_vaccinatedYes" name="is_vaccinated"><label class="custom-control-label" for="is_vaccinatedYes">Yes</label></div><div class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" value="No" id="is_vaccinatedNo" name="is_vaccinated" checked><label class="custom-control-label" for="is_vaccinatedNo">No</label></div><div class="custom-control" style="display: none;" id="is_vaccinated_d"><input type="date" name="is_vaccinated_d" class="form-control" /></div>`;
var is_vaccinated_2 = `<div><label class="col-md-6 radioLabel">Is Vaccinated with 2nd Dose:</label><div class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" value="Yes" id="is_vaccinated_2Yes" name="is_vaccinated_2"><label class="custom-control-label" for="is_vaccinated_2Yes">Yes</label></div><div class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" value="No" id="is_vaccinated_2No" name="is_vaccinated_2" checked><label class="custom-control-label" for="is_vaccinated_2No">No</label></div><div class="custom-control" style="display: none;" id="is_vaccinated_2_d"><input type="date" name="is_vaccinated_2_d" class="form-control" /></div>`;
var travelled = template("travelled", "Travelled");
var chills = template("chills", "Chills");
var quarantine = template("quarantine", "Quarantine");

function template(element_name, title) {
    return `<div><label class="col-md-6 radioLabel">${title}:</label><div class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" value="Yes" id="${element_name}Yes" name="${element_name}"><label class="custom-control-label" for="${element_name}Yes">Yes</label></div><div class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" value="No" id="${element_name}No" name="${element_name}" checked><label class="custom-control-label" for="${element_name}No">No</label></div><div class="custom-control custom-control-inline" id="${element_name}Range" style="display: none;"><select class="form-control" name="${element_name}_s" id="${element_name}_s"><option value="0">None</option><option value="1">Low</option><option value="2">Medium</option><option value="3">High</option></select></div></div>`;
}

$(function () {
    $(".symptoms-1").append(fever);
    select("fever");
    $(".symptoms-1").append(cough);
    select("cough");
    $(".symptoms-1").append(tiredness);
    select("tiredness");
    $(".symptoms-1").append(chest_pain);
    select("chest_pain");
    $(".symptoms-1").append(head_ache);
    select("head_ache");
    $(".symptoms-1").append(stomach_ache);
    select("stomach_ache");
    $(".symptoms-1").append(less_oxygen_level);
    select("less_oxygen_level");
    $(".symptoms-1").append(sore_throat);
    select("sore_throat");
    $(".symptoms-1").append(congestion);
    select("congestion");
    $(".symptoms-1").append(sense_loss);
    select("sense_loss");
    $(".symptoms-1").append(trouble_breathing);
    select("trouble_breathing");
    $(".symptoms-1").append(travelled);
    
    $(".symptoms-2").append(kidney_failure);
    $(".symptoms-2").append(heart_problem);
    select("heart_problem");
    $(".symptoms-2").append(diabetes);
    select("diabetes");
    $(".symptoms-2").append(malignancy_cancer);
    select("malignancy_cancer");
    $(".symptoms-2").append(hypertension);
    select("hypertension");
    $(".symptoms-2").append(liver_disease);
    $(".symptoms-2").append(immunocompromised_condition);
    select("immunocompromised_condition");
    $(".symptoms-2").append(vomiting);
    select("vomiting");
    $(".symptoms-2").append(consume_steroids);
    $(".symptoms-2").append(diarrhea);
    select("diarrhea");
    $(".symptoms-2").append(skin_rash_discoloration);
    $(".symptoms-2").append(chills);

    $(".symptoms-3").append(contact_positive);
    $(".symptoms-3").append(is_positive);
    $(".symptoms-3").append(is_vaccinated);
    selectDate("is_vaccinated");
    $(".symptoms-3").append(is_vaccinated_2);
    selectDate("is_vaccinated_2");
    select("chills");
    $(".symptoms-3").append(quarantine);
});

function select(element) {
    $(`input[name="${element}"]`).click(function () {
        if ($(`#${element}Yes`).is(":checked")) {
            $(`#${element}Range`).show();
            $(`#${element}_s`).children('option[value="0"]').hide();
            $(`#${element}_s`).prop("selectedIndex", 1).val();
        } else {
            $(`#${element}Range`).hide();
            $(`#${element}_s`).children('option[value="0"]').show();
            $(`#${element}_S`).prop("selectedIndex", 0).val();
        }
    });
}

function selectDate(element) {
    $(`input[name="${element}"]`).click(function () {
        if ($(`#${element}Yes`).is(":checked")) {
            $(`#${element}_d`).show();
        } else {
            $(`#${element}_d`).hide();
        }
    });
}
