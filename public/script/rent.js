propertyForm = $("#propertyForm");
$("#properties-form").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    onStepChanging: function(event, currentIndex, newIndex) {
        propertyForm.validate().settings.ignore = ":disabled,:hidden";
        return propertyForm.valid();
    },
    onFinishing: function(event, currentIndex) {
        propertyForm.validate().settings.ignore = ":disabled";
        return propertyForm.valid();
    },
    onFinished: function(event, currentIndex) {
        propertyForm.submit();
    }
});

$(".properties").select2({
    theme: "classic",
    width: 'resolve',
});

$(".tenants").select2({
    theme: "classic",
    width: 'resolve',
});

$(document).ready(function() {
    const monthly_price = $('#monthly_price');
    const yearly_price = $('#yearly_price');
    const start_date = $('#start_date');
    const terms = $('#terms');
    const rent_type = $('#rent_type');
    const discount = $('#discount');
    const amount = $('#amount');
    const end_started = $('#end_date');

    // Event handlers for input changes
    rent_type.add(terms).add(start_date).add(discount).on('change', function() {
        const selectedRentType = rent_type.val();
        const selectedTerms = terms.val();
        const selectedStartDate = start_date.val();
        const selectedDiscount = discount.val();


        changeRentType(selectedRentType, monthly_price.val(), yearly_price.val());
        add_end_date(selectedTerms, selectedStartDate, selectedRentType);

        const selectedAmount = amount.val();
        calculateTotals(selectedAmount, selectedTerms, selectedDiscount);
    });
});

function changeRentType(rent_type, monthly_price, yearly_price) {
    const amount = (rent_type === 'monthly') ? monthly_price : (rent_type === 'yearly') ? yearly_price : '';
    $('#amount').val(amount);
}

function add_end_date(terms, start_date, rent_type) {
    const endDate = moment(start_date).add(terms, (rent_type === 'monthly') ? 'months' : 'years');
    $('#end_date').val(endDate.format('YYYY-MM-DD'));
}

function calculateTotals(amount, terms, discount) {
    const discounted = amount * (discount / 100);
    const total = (amount - discounted) * terms;
    $('#total_amount').val(total.toFixed(2));
}


function getProperties(that) {
    var id = $(that).val();

    $.get({
        url: `/property/${id}`, // Pass id as a route parameter
        success: function(response) {
            console.log(response);
            $('#property_name').val(response.property_name);
            $('#price').val(response.price);
            $('#monthly_price').val(response.monthly);
            $('#yearly_price').val(response.yearly);
        },
        error: function(xhr) {
            // Handle the error
            console.log(xhr.responseText);

            $('#property_name').val('');
            $('#price').val('');
            $('#monthly_price').val('');
            $('#yearly_price').val('');
        }
    });
}

function getTenant(that) {
    var id = $(that).val();

    $.get({
        url: `/tenants/${id}`, // Pass id as a route parameter
        success: function(response) {
            console.log(response);
            $('#name').val(response.name);;
            $('#contact').val(response.contact_no);
            $('#email').val(response.email);
            $('#address').val(response.address);
        },
        error: function(xhr) {
            // Handle the error
            console.log(xhr.responseText);

            $('#name').val('');;
            $('#contact_no').val('');
            $('#email').val('');
            $('#address').val('');
        }
    });
}