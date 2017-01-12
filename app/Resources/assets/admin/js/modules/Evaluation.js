import { EvaluationQuestion } from './EvaluationQuestion';
var Sortable = require('sortablejs');

class Evaluation
{
    constructor()
    {
        this.evaluation = $('[data-evaluation]');
        this.container = this.evaluation.find('[data-container-prototype]');
        this.questions = this.container.find('[data-question]');

        if (0 < this.evaluation.length) {
            this.bind();
        }

        var currentIndex = 1;
        this.questions.each(function() {
            var evaluationQuestion = new EvaluationQuestion($(this), currentIndex);
            currentIndex++;
        });
    }

    getIndex()
    {
        return this.questions.length;
    }

    bind()
    {
        var that = this;

        this.evaluation.find('[data-add-question]').on('click', function (e) {
            e.preventDefault();
            that.addQuestion();
        });

        this.sortable();
    }

    addQuestion()
    {
        var that = this;

        var element = $(that.container.data('prototype').replace(/__name__/g, that.getIndex()));

        element.addClass('animated fadeInUp');
        this.container.append(new EvaluationQuestion(element, that.getIndex() + 1));

        this.questions = this.container.find('[data-question]');
    }

    sortable()
    {
        var el = this.container[0];
        Sortable.create(el, {
            ghostClass: 'ghost',
            handle: '.data-drag',
            scroll: true,
            scrollSensitivity: 80,
            scrollSpeed: 50,
            animation: 150,
            onEnd: function (evt) {
                $(evt.from).children().each(function( index ) {
                    $(this).find('[data-question-position]').val(index+1);
                });
            },
        });
    }
}

export { Evaluation };
