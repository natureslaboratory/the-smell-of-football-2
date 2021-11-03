<?php include 'components/header.php' ?>

        <section class="l-block c-purchase__background">
            <div class="l-restrict c-purchase">
                <h3>GET YOUR SIGNED COPY NOW - £14.99</h3>
                <form action="create-checkout-session.php" method="post" id="checkout-form">
                    <div class="c-purchase__options">
                        <div class="c-purchase__counter">
                            <button class="c-purchase__counter-button c-purchase__counter-button--minus">-</button>
                            <div class="c-purchase__counter-count">0</div>
                            <button class="c-purchase__counter-button c-purchase__counter-button--plus">+</button>
                        </div>
                        <input type="number" class="hidden c-purchase__count-count-input" id="book_count" name="book_count">
                        <input type="submit" class="c-button c-purchase__purchase-button" name="checkout" value="Checkout">
                        <p>(P&P £2.99)</p>
                    </div>
                </form>
            </div>
        </section>
        <section class="l-block">
            <div class="l-restrict c-product">
                <div class="c-product__quotes">
                    <div class="c-quote">
                        <p class="c-quote__text">
                            “A book that encapsulates the author - laugh
                            out load funny one moment, poignant the next
                            but always with a zest for life and a profound
                            love for an industry like no other: a must read.”
                        </p>
                        <p class="c-quote__author">
                            Dominic King
                        </p>
                        <p class="c-quote__paper">
                            Daily Mail
                        </p> 
                    </div>
                    <div class="c-quote">
                        <p class="c-quote__text">
                            “Forget The Empire Strikes Back, Godfather 2,
                            even From Russia With Love (and I love From
                            Russia With Love) but Baz Rathbone’s The Smell
                            Of Football 2 is undeniably the greatest sequel
                            ever written. The Smell Of Football was very
                            highly acclaimed. This is even better - an older
                            man’s battle to prove himself relevant in a
                            young man’s world, it is soul bearingly honest,
                            insightful, wildly entertaining and laugh
                            out loud funny. It is poignant, perceptive and
                            utterly charming. And guess what? If you think
                            no-one can beat the march of time, think again.
                            Passionately recommended.”
                        </p>
                        <p class="c-quote__author">
                            David Prentice
                        </p>
                        <p class="c-quote__paper">
                            Liverpool Echo Sports Editor
                        </p> 
                    </div>
                </div>
                <img class="c-product__image" src="/assets/images/book_small.jpg" alt="The Smell Of Football 2 Book">
            </div>
        </section>
        <section class="l-block c-banner">
            <div class="l-restrict">
                <p>The much anticipated sequel to the 2011 Cult Hit</p>
                <h4>MICK ‘BAZ’ RATHBONE</h4>
            </div>
        </section>
        <section class="l-block c-images">
            <div class="restrict c-images__container">
                <div class="c-images__image">
                    <img src="/assets/images/300w/IMG_0044_300w.jpg" alt="Mick Rathbone">
                </div>
                <div class="c-images__image">
                    <img src="/assets/images/300w/IMG_0087_300w.JPG" alt="Training on the beach">
                </div>
                <div class="c-images__image">
                    <img src="/assets/images/300w/IMG_0467_300w.JPG" alt="The team">
                </div>
                <div class="c-images__image">
                    <img src="/assets/images/300w/IMG_0484_300w.JPG" alt="Football Pitch">
                </div>
            </div>
        </section>
        <section class="l-block c-bio">
            <div class="l-restrict l-restrict--narrow c-bio__wrapper">
                <h3>ABOUT THE AUTHOR</h3>
                <p class="c-bio__text">
                Mick (Baz) Rathbone was born in Birmingham in 1958. Highly academic, he was determined to become a Doctor.
                He was also an outstanding long distance runner and footballer. Against the advice of his father and headmaster,
                he left school at 16 years of age to sign apprentice professional forms for his local football club, Birmingham City
                F.C. Things went very well at first and he was selected to play for the England Youth Team. He also made his senior
                league debut at Tottenham that same season at only 17 years of age. He had the world at his feet. Great things
                were predicted for this lad from Sheldon. Unfortunately, things started to go wrong and the strain of playing top flight
                football, as a teenager, for the club that he had supported, became too much. His career imploded and it reached
                the point where he didn’t want to play football any more. Luckily, he went on loan to Blackburn Rovers in 1979 and
                the physical separation from his home town allowed him to have a relatively successful lower league career. There
                were still many challenges along the way but eventually he became a Chartered Physiotherapist, working his way
                up from the lower leagues, to becoming head of the medical department at Everton F.C. in 2002, at 44 years of
                age. He enjoyed a successful 8 years at Everton. When he left in 2010 he wrote a much acclaimed book called <strong>The
                Smell Of Football</strong>, which spoke openly about his struggles with self confidence. The book was highly successful
                and was nominated for several prestigious literary awards. The much anticipated sequel; <strong>The Smell Of Football 2</strong>
                has now been written and is receiving similar accolades. It covers 11 years and 10 different football teams and deals
                with the issues of getting older in a sport fixated on youth.
                </p>
            </div>
        </section>
<?php include 'components/footer.php' ?>