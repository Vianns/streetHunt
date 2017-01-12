class EvaluationAnswer
{
    constructor(answer, index)
    {
        this.index = index;
        this.answer = answer;
        this.bind();

        return answer;
    }

    bind()
    {
        var that = this;

        this.answer.find('[data-answer-position]').val(this.index);

        this.answer.find('[data-del-choice]').on('click', function(e) {
            var r = confirm("Êtes vous sûr de vouloir supprimer cette réponse ?");
            if (r == true) {
                that.answer.remove();
            }
            e.preventDefault();
        });
    }
}

export { EvaluationAnswer };
