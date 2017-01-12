import { EvaluationAnswer } from './EvaluationAnswer';
var Sortable = require('sortablejs');

class EvaluationQuestion
{
    constructor(element, indexQuestion)
    {
        this.element = element;
        this.indexQuestion = indexQuestion;

        this.selectType = this.element.find('[data-question-type]');
        this.btnAddAnswer = this.element.find('[data-add-answer]');
        this.btnDelAnswer = this.element.find('[data-question-del]');
        this.answers = this.element.find('[data-answers]');
        this.answer = this.element.find('[data-answer]');
        this.elementData = this.element.data();

        this.bind();

        return this.element;
    }

    bind()
    {
        var that = this;

        this.element.find('[data-question-position]').val(this.indexQuestion);
        this.element.find('[data-index-question]').text(this.indexQuestion);
        this.answer.each(function(index) {
            new EvaluationAnswer($(this), index + 1);
        });

        this.toogleBtnChoice();

        this.selectType.on('change', function(e) {
            e.preventDefault;
            that.toogleBtnChoice(true);
        });

        this.btnAddAnswer.on('click', function (e) {
            e.preventDefault();
            that.addAnswer();
        });

        this.btnDelAnswer.on('click', function (e) {
            var r = confirm(that.elementData.errorDel);
            if (r == true) {
                that.element.remove();
            }
            e.preventDefault();
        });

        this.sortable();
    }

    toogleBtnChoice(animated = false)
    {
        var that = this;


        var selectedValue = that.selectType.find('option:selected').data('value');
        if (animated && 0 < that.answer.length && -1 === $.inArray(parseInt(selectedValue), that.elementData.typeWithChoice)) {
            var r = confirm(that.elementData.errorChange);
            if (r == true) {
                that.answer.remove();
            } else {
                that.selectType.find('option[value="'+that.lastSelectedValue+'"]').prop('selected', true);
            }
        }

        var selectedValue = that.selectType.find('option:selected').data('value');
        if (-1 !== $.inArray(parseInt(selectedValue), that.elementData.typeWithChoice)) {
            that.btnAddAnswer.removeClass('hide');
            if (animated) {
                that.btnAddAnswer.addClass('animated bounceIn');
            }
        } else {
            that.btnAddAnswer.addClass('hide');
        }

        that.lastSelectedValue = that.selectType.val();
    }

    addAnswer()
    {
        var that = this;
        var element = $(that.elementData.prototypeAnswer.replace(/__subname__/g, that.getIndex()));

        element.addClass('animated fadeInUp');
        that.answers.append(new EvaluationAnswer(element, that.getIndex() + 1));
        that.answer = that.element.find('[data-answer]');
    }

    getIndex()
    {
        return this.answer.length;
    }

    sortable()
    {
        var el = this.answers[0];
        Sortable.create(el, {
            ghostClass: 'ghost',
            handle: '.data-drag',
            animation: 150,
            onEnd: function (evt) {
                $(evt.from).children().each(function( index ) {
                    $(this).find('[data-answer-position]').val(index+1);
                });
            },
        });
    }
}

export { EvaluationQuestion };
