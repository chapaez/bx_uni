(function() {
    function ready() {
        var persons = document.querySelectorAll('.bl-person');
        [].forEach.call(persons, function(item) {
            item.addEventListener('click', handlePersonClick);
            item.addEventListener('touchstart', handlePersonClick);

        });
    }

    function handlePersonClick(event) {
        console.log('click');
        if (this.hasAttribute('disabled')) return false

        var currentLoader, sibling, voteTotal, voteSibling, voteThis;
        sibling = this.nextElementSibling ? this.nextElementSibling : this.previousElementSibling;
        this.classList.add('bl-person_disabled');

        voteThis = parseInt(this.getAttribute('data-votes-count')) + 1;
        voteSibling = parseInt(sibling.getAttribute('data-votes-count'));
        this.setAttribute('data-votes-count', voteThis);
        voteTotal = voteThis + voteSibling;
        voteThisPercent = Math.round((voteThis / voteTotal) * 100) + '%';
        voteSiblingPercent = Math.round((voteSibling / voteTotal) * 100) + '%';
        this.setAttribute('data-result', voteThisPercent);
        sibling.setAttribute('data-result', voteSiblingPercent);

        sibling.classList.add('bl-person_disabled');
        this.setAttribute('disabled', true);
        sibling.setAttribute('disabled', true);

        currentLoader = this.parentElement.previousElementSibling.querySelector('.bl-loader');
        currentLoader.classList.remove('bl-loader_empty');
        currentLoader.classList.add('bl-loader_loading');

        var sendData = {};
        sendData.id = this.parentElement.parentElement.parentElement.getAttribute('data-vote-id');
        sendData.item = this.getAttribute('data-option-num');
        sendData.count = voteThis;
        //console.log('sendData', sendData);
        var self = this;
        $.ajax({
            type: 'POST',
            url: '/ajax/image_poll/',
            data: sendData,
            dataType: "json",
            success: function (data) {
                setTimeout(function() {
                    self.parentElement.parentElement.parentElement.classList.add('bl-vote-item_voted');
                    self.classList.remove('bl-person_disabled');
                    self.classList.add('bl-person_selected', 'bl-person_result');
                    sibling.classList.add('bl-person_result');
                }, 2000);
                //console.log('postData', data)
            }
        });
    }

    document.addEventListener("DOMContentLoaded", ready);
})()
